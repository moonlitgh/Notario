<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->tasks();
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by due date
        if ($request->has('due')) {
            if ($request->due == 'today') {
                $query->whereDate('due_date', today());
            } elseif ($request->due == 'week') {
                $query->whereBetween('due_date', [now(), now()->addWeek()]);
            } elseif ($request->due == 'month') {
                $query->whereBetween('due_date', [now(), now()->addMonth()]);
            }
        }
        
        // Sort tasks
        if ($request->has('sort')) {
            if ($request->sort == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'oldest') {
                $query->orderBy('created_at', 'asc');
            } elseif ($request->sort == 'priority') {
                $query->orderByRaw("CASE 
                    WHEN priority = 'high' THEN 1 
                    WHEN priority = 'medium' THEN 2 
                    WHEN priority = 'low' THEN 3 
                    END");
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        // Search
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        $tasks = $query->get();
        
        // Get all tasks for statistics
        $allTasks = Auth::user()->tasks;
        
        // Calculate task statistics
        $totalTasks = $allTasks->count();
        $completedTasks = $allTasks->where('status', 'completed')->count();
        $inProgressTasks = $allTasks->where('status', 'in_progress')->count();
        $overdueTasks = $allTasks->where('status', 'overdue')->count();
        
        // Task statistics by priority
        $highPriorityCount = $allTasks->where('priority', 'high')->count();
        $mediumPriorityCount = $allTasks->where('priority', 'medium')->count();
        $lowPriorityCount = $allTasks->where('priority', 'low')->count();
        
        // Task statistics by status
        $pendingCount = $allTasks->where('status', 'pending')->count();
        $inProgressCount = $allTasks->where('status', 'in_progress')->count(); // Add this line
        $completedCount = $allTasks->where('status', 'completed')->count(); // Add this line too for consistency
        
        // Due date statistics
        $dueTodayCount = $allTasks->filter(function($task) {
            return $task->due_date && $task->due_date->isToday();
        })->count();
        
        $dueTomorrowCount = $allTasks->filter(function($task) {
            return $task->due_date && $task->due_date->isTomorrow();
        })->count();
        
        $dueThisWeekCount = $allTasks->filter(function($task) {
            return $task->due_date && $task->due_date->isCurrentWeek();
        })->count();
        
        // Completed task statistics
        $completedTodayCount = $allTasks->where('status', 'completed')
            ->filter(function($task) {
                return $task->updated_at->isToday();
            })->count();
            
        $completedThisWeekCount = $allTasks->where('status', 'completed')
            ->filter(function($task) {
                return $task->updated_at->isCurrentWeek();
            })->count();
            
        $completedThisMonthCount = $allTasks->where('status', 'completed')
            ->filter(function($task) {
                return $task->updated_at->isCurrentMonth();
            })->count();
        
        return view('dashboard', compact(
            'tasks', 'totalTasks', 'completedTasks', 'inProgressTasks', 'overdueTasks',
            'highPriorityCount', 'mediumPriorityCount', 'lowPriorityCount',
            'pendingCount', 'inProgressCount', 'completedCount', 
            'dueTodayCount', 'dueTomorrowCount', 'dueThisWeekCount',
            'completedTodayCount', 'completedThisWeekCount', 'completedThisMonthCount'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->status = 'pending';
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Pastikan pengguna hanya dapat mengupdate tugas miliknya
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        // Keep the existing status
        // $task->status = $request->status; - removed
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Pastikan pengguna hanya dapat menghapus tugas miliknya
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }
    
    /**
     * Toggle task status between completed and pending.
     */
    public function toggleStatus(Task $task)
    {
        // Pastikan pengguna hanya dapat mengubah status tugas miliknya
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
        }

        if ($task->status === 'completed') {
            $task->status = 'pending';
        } else {
            $task->status = 'completed';
        }
        
        $task->save();

        return redirect()->route('dashboard')->with('success', 'Task status updated!');
    }
}