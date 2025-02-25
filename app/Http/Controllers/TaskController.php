<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Helpers\CaseNumberGenerator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        // Filter berdasarkan status
        if ($request->has('status')) {
            switch ($request->status) {
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

        $tasks = $query->orderBy('due_date')->paginate(10);

        return view('tasks.index', [
            'tasks' => $tasks,
            'currentStatus' => $request->status ?? 'all'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'due_date' => 'required|date',
                'priority' => 'required|in:low,medium,high'
            ]);

            $task = Task::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'due_date' => $validated['due_date'],
                'priority' => $validated['priority'],
                'status' => 'pending',
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Task created successfully',
                'task' => $task
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create task',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($validated);

        return redirect()->route('dashboard')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        
        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,in_progress,overdue'
        ]);

        $task->update($validated);

        return response()->json(['success' => true]);
    }
}
