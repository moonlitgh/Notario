<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Notario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0d3b49',
                        secondary: '#ff9f1c',
                        accent: '#17b897',
                        'task-teal': '#0fb5b5'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        /* FullCalendar customization */
        .fc-theme-standard .fc-scrollgrid {
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .fc-theme-standard td, .fc-theme-standard th {
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .fc .fc-daygrid-day-number {
            color: white;
        }
        .fc .fc-col-header-cell-cushion {
            color: white;
        }
        .fc-daygrid-day-events {
            margin-top: 0;
        }
        .fc-h-event {
            background-color: #17b897;
            border-color: #17b897;
        }
        .fc-daygrid-day.fc-day-today {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-primary hero-pattern text-white font-poppins min-h-screen">
    <!-- Navigation Bar -->
    <nav class="flex justify-between items-center p-3 border-b border-gray-700/50 backdrop-blur-sm bg-primary/70 sticky top-0 z-50">
        <div class="text-xl font-bold flex items-center">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/notario-logo.png') }}" alt="Notario" class="h-6 mr-2">
            </a>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-300">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3 py-1 bg-task-teal/90 text-white rounded-md text-sm hover:bg-task-teal transition-all">
                    Log Out
                </button>
            </form>
        </div>
    </nav>

    <!-- Dashboard Header -->
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-task-teal/90 p-4 rounded-lg">
                <h3 class="text-xs text-white/70 mb-1">Total Tasks</h3>
                <p class="text-2xl font-bold">{{ $totalTasks }}</p>
            </div>
            <div class="bg-task-teal/90 p-4 rounded-lg">
                <h3 class="text-xs text-white/70 mb-1">Completed</h3>
                <p class="text-2xl font-bold">{{ $completedTasks }}</p>
            </div>
            <div class="bg-task-teal/90 p-4 rounded-lg">
                <h3 class="text-xs text-white/70 mb-1">In Progress</h3>
                <p class="text-2xl font-bold">{{ $inProgressTasks }}</p>
            </div>
            <div class="bg-task-teal/90 p-4 rounded-lg">
                <h3 class="text-xs text-white/70 mb-1">Overdue</h3>
                <p class="text-2xl font-bold">{{ $overdueTasks }}</p>
            </div>
        </div>
        
        <!-- Remove the standalone form that appears here -->
        
        <!-- Main Content -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Form Tambah Tugas -->
            <div class="md:col-span-1 bg-task-teal/90 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Add New Task</h2>
                </div>
                
                <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-white mb-1">Task Title</label>
                        <input type="text" id="title" name="title" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent placeholder-white/50" placeholder="Enter task title" required>
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-white mb-1">Description</label>
                        <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent placeholder-white/50" placeholder="Enter task description"></textarea>
                    </div>
                    
                    <div>
                        <label for="priority" class="block text-sm font-medium text-white mb-1">Priority</label>
                        <select id="priority" name="priority" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent">
                            <option value="low" class="bg-primary text-white">Low</option>
                            <option value="medium" selected class="bg-primary text-white">Medium</option>
                            <option value="high" class="bg-primary text-white">High</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-white mb-1">Due Date</label>
                        <input type="datetime-local" id="due_date" name="due_date" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent">
                    </div>
                    
                    <button type="submit" class="w-full py-2 bg-accent text-white rounded-md hover:bg-accent/80 transition-all">
                        <i class="fas fa-plus mr-1"></i> Create Task
                    </button>
                </form>
            </div>
            
            <!-- Calendar -->
            <div class="md:col-span-2 bg-task-teal/90 p-4 rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Calendar</h2>
                </div>
                
                <div id="calendar"></div>
            </div>
        </div>
        
        <!-- Task Actions -->
        <div class="mt-6 flex space-x-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 {{ request()->routeIs('dashboard') && !request()->query('status') ? 'bg-task-teal/90' : 'bg-white/10' }} rounded text-sm hover:bg-task-teal transition-all">
                All Tasks
            </a>
            <a href="{{ route('dashboard', ['status' => 'completed']) }}" class="px-4 py-2 {{ request()->query('status') == 'completed' ? 'bg-task-teal/90' : 'bg-white/10' }} rounded text-sm hover:bg-white/20 transition-all">
                Completed
            </a>
            <a href="{{ route('dashboard', ['status' => 'in_progress']) }}" class="px-4 py-2 {{ request()->query('status') == 'in_progress' ? 'bg-task-teal/90' : 'bg-white/10' }} rounded text-sm hover:bg-white/20 transition-all">
                In Progress
            </a>
            <a href="{{ route('dashboard', ['status' => 'pending']) }}" class="px-4 py-2 {{ request()->query('status') == 'pending' ? 'bg-task-teal/90' : 'bg-white/10' }} rounded text-sm hover:bg-white/20 transition-all">
                Pending
            </a>
            <a href="{{ route('dashboard', ['status' => 'overdue']) }}" class="px-4 py-2 {{ request()->query('status') == 'overdue' ? 'bg-task-teal/90' : 'bg-white/10' }} rounded text-sm hover:bg-white/20 transition-all">
                Overdue
            </a>
        </div>
        
        <!-- Task Filters -->
        <div class="mt-4 flex justify-between items-center">
            <div class="flex space-x-2">
                <form action="{{ route('dashboard') }}" method="GET" class="flex space-x-2">
                    @if(request()->has('status'))
                        <input type="hidden" name="status" value="{{ request()->query('status') }}">
                    @endif
                    <select name="sort" onchange="this.form.submit()" class="bg-white/10 text-white text-sm rounded px-3 py-2 focus:outline-none">
                        <option value="" class="bg-primary text-white">Sort by</option>
                        <option value="newest" {{ request()->query('sort') == 'newest' ? 'selected' : '' }} class="bg-primary text-white">Date (Newest)</option>
                        <option value="oldest" {{ request()->query('sort') == 'oldest' ? 'selected' : '' }} class="bg-primary text-white">Date (Oldest)</option>
                        <option value="priority" {{ request()->query('sort') == 'priority' ? 'selected' : '' }} class="bg-primary text-white">Priority</option>
                    </select>
                    <select name="due" onchange="this.form.submit()" class="bg-white/10 text-white text-sm rounded px-3 py-2 focus:outline-none">
                        <option value="" class="bg-primary text-white">Due Date</option>
                        <option value="today" {{ request()->query('due') == 'today' ? 'selected' : '' }} class="bg-primary text-white">Today</option>
                        <option value="week" {{ request()->query('due') == 'week' ? 'selected' : '' }} class="bg-primary text-white">This Week</option>
                        <option value="month" {{ request()->query('due') == 'month' ? 'selected' : '' }} class="bg-primary text-white">This Month</option>
                    </select>
                </form>
            </div>
            <form action="{{ route('dashboard') }}" method="GET" class="flex">
                <input type="text" name="search" value="{{ request()->query('search') }}" placeholder="Search tasks..." class="bg-white/10 text-white text-sm rounded-l px-3 py-2 focus:outline-none placeholder-white/50">
                <button type="submit" class="px-4 py-2 bg-task-teal/90 rounded-r text-sm hover:bg-task-teal transition-all">
                    Search
                </button>
            </form>
        </div>
        
        <!-- Task List -->
        <div class="mt-6 bg-task-teal/90 rounded-lg p-4">
            <h2 class="text-xl font-bold mb-4">Your Tasks</h2>
            
            @if($tasks->count() > 0)
                <div class="space-y-3">
                    @foreach($tasks as $task)
                        <div class="bg-white/10 p-4 rounded-lg hover:bg-white/20 transition-all">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <h3 class="font-semibold text-lg">{{ $task->title }}</h3>
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($task->priority == 'high') bg-red-500/70 
                                            @elseif($task->priority == 'medium') bg-yellow-500/70 
                                            @else bg-blue-500/70 @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($task->status == 'completed') bg-green-500/70 
                                            @elseif($task->status == 'in_progress') bg-purple-500/70 
                                            @elseif($task->status == 'overdue') bg-red-500/70 
                                            @else bg-gray-500/70 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-white/80 mt-1">{{ $task->description }}</p>
                                    @if($task->due_date)
                                        <p class="text-xs text-white/70 mt-2">
                                            <i class="fas fa-calendar-alt mr-1"></i> Due: {{ $task->due_date->format('M d, Y g:i A') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    <form action="{{ route('tasks.toggle-status', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-all text-sm">
                                            @if($task->status == 'completed')
                                                <i class="fas fa-undo text-yellow-400"></i>
                                            @else
                                                <i class="fas fa-check text-green-400"></i>
                                            @endif
                                        </button>
                                    </form>
                                    <button type="button" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-all text-sm edit-task" data-task="{{ json_encode($task) }}">
                                        <i class="fas fa-edit text-cyan-300"></i>
                                    </button>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-all text-sm">
                                            <i class="fas fa-trash text-red-400"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white/10 p-8 rounded-lg text-center">
                    <i class="fas fa-tasks text-4xl mb-4 text-gray-400"></i>
                    <h3 class="text-xl font-semibold mb-2">No tasks found</h3>
                    <p class="text-gray-300">You don't have any tasks matching your filters.</p>
                </div>
            @endif
        </div>
        
        <!-- Task Statistics -->
        <div class="mt-10">
            <h2 class="text-xl font-bold mb-4">Task Statistics</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-task-teal/90 p-4 rounded-lg">
                    <h3 class="text-sm font-medium mb-2">Tasks by Priority</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>High</span>
                            <span>{{ $highPriorityCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Medium</span>
                            <span>{{ $mediumPriorityCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Low</span>
                            <span>{{ $lowPriorityCount }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-task-teal/90 p-4 rounded-lg">
                    <h3 class="text-sm font-medium mb-2">Tasks by Status</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Pending</span>
                            <span>{{ $pendingCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>In Progress</span>
                            <span>{{ $inProgressCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Completed</span>
                            <span>{{ $completedCount }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-task-teal/90 p-4 rounded-lg">
                    <h3 class="text-sm font-medium mb-2">Due This Week</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Today</span>
                            <span>{{ $dueTodayCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tomorrow</span>
                            <span>{{ $dueTomorrowCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>This Week</span>
                            <span>{{ $dueThisWeekCount }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-task-teal/90 p-4 rounded-lg">
                    <h3 class="text-sm font-medium mb-2">Completed Tasks</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Today</span>
                            <span>{{ $completedTodayCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>This Week</span>
                            <span>{{ $completedThisWeekCount }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>This Month</span>
                            <span>{{ $completedThisMonthCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="border-t border-gray-700/50 py-4 mt-10">
        <div class="container mx-auto px-4">
            <div class="flex justify-center space-x-4 text-xs text-gray-400">
                <a href="#" class="hover:text-white">Dashboard</a>
                <span>|</span>
                <a href="#" class="hover:text-white">Tasks</a>
                <span>|</span>
                <a href="#" class="hover:text-white">Calendar</a>
                <span>|</span>
                <a href="#" class="hover:text-white">Reports</a>
                <span>|</span>
                <a href="#" class="hover:text-white">Settings</a>
            </div>
        </div>
    </footer>

    <!-- Edit Task Modal -->
    <div id="editTaskModal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
        <div class="bg-primary border border-gray-700 rounded-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Edit Task</h3>
                <button type="button" class="text-gray-400 hover:text-white" id="closeEditModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="editTaskForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_title" class="block text-sm font-medium text-white mb-1">Task Title</label>
                    <input type="text" id="edit_title" name="title" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent placeholder-white/50" required>
                </div>
                
                <div>
                    <label for="edit_description" class="block text-sm font-medium text-white mb-1">Description</label>
                    <textarea id="edit_description" name="description" rows="3" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent placeholder-white/50"></textarea>
                </div>
                
                <div>
                    <label for="edit_priority" class="block text-sm font-medium text-white mb-1">Priority</label>
                    <select id="edit_priority" name="priority" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent">
                        <option value="low" class="bg-primary text-white">Low</option>
                        <option value="medium" class="bg-primary text-white">Medium</option>
                        <option value="high" class="bg-primary text-white">High</option>
                    </select>
                </div>
                
                <!-- Status field removed -->
                <input type="hidden" id="edit_status" name="status" value="">
                
                <div>
                    <label for="edit_due_date" class="block text-sm font-medium text-white mb-1">Due Date</label>
                    <input type="datetime-local" id="edit_due_date" name="due_date" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-accent">
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" id="cancelEditBtn" class="px-4 py-2 bg-white/10 text-white rounded-md hover:bg-white/20 transition-all">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-accent text-white rounded-md hover:bg-accent/80 transition-all">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    @foreach($tasks as $task)
                    {
                        id: '{{ $task->id }}',
                        title: '{{ $task->title }}',
                        start: '{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}',
                        @if($task->status == 'completed')
                        backgroundColor: '#10B981',
                        @elseif($task->status == 'overdue')
                        backgroundColor: '#EF4444',
                        @elseif($task->priority == 'high')
                        backgroundColor: '#F59E0B',
                        @endif
                        extendedProps: {
                            description: '{{ $task->description }}',
                            priority: '{{ $task->priority }}',
                            status: '{{ $task->status }}',
                            dueTime: '{{ $task->due_date ? $task->due_date->format('g:i A') : '' }}'
                        }
                    },
                    @endforeach
                ],
                height: 400,
                themeSystem: 'standard',
                // Add date click handler
                dateClick: function(info) {
                    showDayTasksModal(info.dateStr);
                }
            });
            calendar.render();
            
            // Function to show tasks for a specific day
            function showDayTasksModal(dateStr) {
                // Get all tasks for the selected date
                const tasksForDay = [];
                
                @foreach($tasks as $task)
                    @if($task->due_date)
                    if ('{{ $task->due_date->format('Y-m-d') }}' === dateStr) {
                        tasksForDay.push({
                            id: {{ $task->id }},
                            title: '{{ $task->title }}',
                            description: '{{ $task->description }}',
                            priority: '{{ $task->priority }}',
                            status: '{{ $task->status }}',
                            dueDate: '{{ $task->due_date->format('M d, Y') }}',
                            dueTime: '{{ $task->due_date->format('g:i A') }}'
                        });
                    }
                    @endif
                @endforeach
                
                // Create and show modal
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black/70 flex items-center justify-center z-50';
                
                // Format date for display
                const displayDate = new Date(dateStr);
                const formattedDate = displayDate.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
                
                // Create modal content
                let modalContent = `
                    <div class="bg-primary border border-gray-700 rounded-lg p-6 w-full max-w-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold">Tasks for ${formattedDate}</h3>
                            <button type="button" class="text-gray-400 hover:text-white close-day-modal">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <div class="max-h-96 overflow-y-auto">
                `;
                
                if (tasksForDay.length > 0) {
                    modalContent += `<div class="space-y-3">`;
                    
                    tasksForDay.forEach(task => {
                        let statusBg = '';
                        if (task.status === 'completed') statusBg = 'bg-green-500/70';
                        else if (task.status === 'in_progress') statusBg = 'bg-purple-500/70';
                        else if (task.status === 'overdue') statusBg = 'bg-red-500/70';
                        else statusBg = 'bg-gray-500/70';
                        
                        let priorityBg = '';
                        if (task.priority === 'high') priorityBg = 'bg-red-500/70';
                        else if (task.priority === 'medium') priorityBg = 'bg-yellow-500/70';
                        else priorityBg = 'bg-blue-500/70';
                        
                        modalContent += `
                            <div class="bg-white/10 p-4 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <h3 class="font-semibold text-lg">${task.title}</h3>
                                            <span class="px-2 py-1 text-xs rounded-full ${priorityBg}">
                                                ${task.priority.charAt(0).toUpperCase() + task.priority.slice(1)}
                                            </span>
                                            <span class="px-2 py-1 text-xs rounded-full ${statusBg}">
                                                ${task.status.charAt(0).toUpperCase() + task.status.slice(1).replace('_', ' ')}
                                            </span>
                                        </div>
                                        <p class="text-sm text-white/80 mt-1">${task.description || 'No description'}</p>
                                        <p class="text-xs text-white/70 mt-2">
                                            <i class="fas fa-calendar-alt mr-1"></i> Due: ${task.dueDate} at ${task.dueTime}
                                        </p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <form action="/tasks/toggle-status/${task.id}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-all text-sm">
                                                ${task.status === 'completed' ? 
                                                    '<i class="fas fa-undo text-yellow-400"></i>' : 
                                                    '<i class="fas fa-check text-green-400"></i>'}
                                            </button>
                                        </form>
                                        <button type="button" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-all text-sm edit-task-from-modal" data-task-id="${task.id}">
                                            <i class="fas fa-edit text-cyan-300"></i>
                                        </button>
                                        <form action="/tasks/${task.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-all text-sm">
                                                <i class="fas fa-trash text-red-400"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    
                    modalContent += `</div>`;
                } else {
                    modalContent += `
                        <div class="bg-white/10 p-8 rounded-lg text-center">
                            <i class="fas fa-calendar-day text-4xl mb-4 text-gray-400"></i>
                            <h3 class="text-xl font-semibold mb-2">No tasks for this day</h3>
                            <p class="text-white/70">You don't have any tasks scheduled for this date.</p>
                        </div>
                    `;
                }
                
                modalContent += `
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="button" class="px-4 py-2 bg-white/10 text-white rounded-md hover:bg-white/20 transition-all close-day-modal">
                                Close
                            </button>
                        </div>
                    </div>
                `;
                
                modal.innerHTML = modalContent;
                document.body.appendChild(modal);
                
                // Add event listeners for close buttons
                const closeButtons = modal.querySelectorAll('.close-day-modal');
                closeButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        document.body.removeChild(modal);
                    });
                });
                
                // Close when clicking outside
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        document.body.removeChild(modal);
                    }
                });
                
                // Add event listeners for edit buttons
                const editButtons = modal.querySelectorAll('.edit-task-from-modal');
                editButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const taskId = button.getAttribute('data-task-id');
                        // Find the edit button in the main page with this task ID
                        const mainEditButtons = document.querySelectorAll('.edit-task');
                        mainEditButtons.forEach(mainButton => {
                            const task = JSON.parse(mainButton.getAttribute('data-task'));
                            if (task.id == taskId) {
                                // Trigger click on the main edit button
                                mainButton.click();
                                // Close the day modal
                                document.body.removeChild(modal);
                            }
                        });
                    });
                });
            }
            
            // Edit Task Modal
            const editTaskModal = document.getElementById('editTaskModal');
            const editTaskForm = document.getElementById('editTaskForm');
            const editButtons = document.querySelectorAll('.edit-task');
            const closeEditModal = document.getElementById('closeEditModal');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const task = JSON.parse(this.getAttribute('data-task'));
                    
                    // Set form action
                    editTaskForm.action = `/tasks/${task.id}`;
                    
                    // Fill form fields
                    document.getElementById('edit_title').value = task.title;
                    document.getElementById('edit_description').value = task.description || '';
                    document.getElementById('edit_priority').value = task.priority;
                    // We're not setting the status field anymore as it's removed
                    
                    if (task.due_date) {
                        // Format date for datetime-local input
                        const dueDate = new Date(task.due_date);
                        const formattedDate = dueDate.toISOString().slice(0, 16);
                        document.getElementById('edit_due_date').value = formattedDate;
                    } else {
                        document.getElementById('edit_due_date').value = '';
                    }
                    
                    // Show modal
                    editTaskModal.classList.remove('hidden');
                });
            });
            
            // Close modal events
            closeEditModal.addEventListener('click', function() {
                editTaskModal.classList.add('hidden');
            });
            
            cancelEditBtn.addEventListener('click', function() {
                editTaskModal.classList.add('hidden');
            });
            
            // Close modal when clicking outside
            editTaskModal.addEventListener('click', function(e) {
                if (e.target === editTaskModal) {
                    editTaskModal.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>