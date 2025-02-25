<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();
        
        // Apply search if exists
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('case_number', 'like', "%{$searchTerm}%");
            });
        }
        
        // Apply filters
        if ($request->filter) {
            switch ($request->filter) {
                case 'in_progress':
                    $query->where('status', 'in_progress');
                    break;
                case 'completed':
                    $query->where('status', 'completed');
                    break;
                case 'pending':
                    $query->where('status', 'pending');
                    break;
                case 'overdue':
                    $query->where('status', 'overdue');
                    break;
            }
        }

        // Get filtered tasks with pagination
        $filteredTasks = $query->latest()->paginate(5)->withQueryString();

        // Calculate all statistics
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'completed')->count();
        $inProgressTasks = Task::where('status', 'in_progress')->count();
        $overdueTasks = Task::where('status', 'overdue')->count();
        $pendingTasks = Task::where('status', 'pending')->count();
        
        // Priority statistics
        $highPriorityCount = Task::where('priority', 'high')->count();
        $mediumPriorityCount = Task::where('priority', 'medium')->count();
        $lowPriorityCount = Task::where('priority', 'low')->count();
        
        // Due this week
        $dueThisWeek = Task::whereBetween('due_date', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        // Calculate completion rate
        $completionRate = $totalTasks > 0 
            ? round(($completedTasks / $totalTasks) * 100) 
            : 0;

        // Calendar events
        $calendarEvents = Task::all()->map(function ($task) {
            return [
                'title' => $task->title,
                'start' => $task->due_date->format('Y-m-d\TH:i:s'),
                'end' => $task->due_date->format('Y-m-d\TH:i:s'),
                'priority' => $task->priority,
                'extendedProps' => [
                    'case_number' => $task->case_number,
                    'status' => $task->status
                ]
            ];
        });

        return view('dashboard', [
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'inProgressTasks' => $inProgressTasks,
            'overdueTasks' => $overdueTasks,
            'pendingTasks' => $pendingTasks,
            'highPriorityCount' => $highPriorityCount,
            'mediumPriorityCount' => $mediumPriorityCount,
            'lowPriorityCount' => $lowPriorityCount,
            'dueThisWeek' => $dueThisWeek,
            'completionRate' => $completionRate,
            'allTasks' => Task::latest()->get(),
            'filteredTasks' => $filteredTasks,
            'calendarEvents' => $calendarEvents,
        ]);
    }

    private function getStatusColor($status)
    {
        return match($status) {
            'completed' => '#10B981', // green-500
            'in_progress' => '#8B5CF6', // purple-500
            'pending' => '#EC4899', // pink-500
            'overdue' => '#EF4444', // red-500
            default => '#6B7280' // gray-500
        };
    }
}
