<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport"
        content="width=<x-app-layout>
    <!-- Add FullCalendar CSS -->
    @push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
@endpush

    <div class="relative
        min-h-screen bg-[#0F2C33]">
    <!-- Background Gradients -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div
            class="absolute -top-20 left-1/4 w-[500px] h-[500px] bg-[#21616A] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob">
        </div>
        <div
            class="absolute top-1/3 -right-20 w-[600px] h-[600px] bg-[#2E9CA0] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-20 left-1/3 w-[550px] h-[550px] bg-[#EFA00F] rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob animation-delay-4000">
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-[#E6D1B4] mb-8">Dashboard</h1>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Tasks -->
                <div class="bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                    <h3 class="text-lg font-medium text-[#E6D1B4]/70">Total Tasks</h3>
                    <p class="text-3xl font-bold text-[#E6D1B4]">{{ $totalTasks }}</p>
                </div>

                <!-- Completed Tasks -->
                <div class="bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                    <h3 class="text-lg font-medium text-[#E6D1B4]/70">Completed</h3>
                    <p class="text-3xl font-bold text-[#2E9CA0]">{{ $completedTasks }}</p>
                </div>

                <!-- In Progress Tasks -->
                <div class="bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                    <h3 class="text-lg font-medium text-[#E6D1B4]/70">In Progress</h3>
                    <p class="text-3xl font-bold text-[#EFA00F]">{{ $inProgressTasks }}</p>
                </div>

                <!-- Overdue Tasks -->
                <div class="bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                    <h3 class="text-lg font-medium text-[#E6D1B4]/70">Overdue</h3>
                    <p class="text-3xl font-bold text-red-400">{{ $overdueTasks }}</p>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Tasks Column -->
                <div class="bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center space-x-3">
                            <h2 class="text-2xl font-bold text-[#E6D1B4]">To Do Tasks</h2>
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                                {{ $totalTasks }}
                            </span>
                        </div>
                        <div x-data="{
                            showModal: false,
                            task: {
                                title: '',
                                description: '',
                                due_date: '',
                                due_time: '',
                                priority: 'medium'
                            },
                            async handleSubmit() {
                                try {
                                    const response = await fetch('/tasks', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                        },
                                        body: JSON.stringify(this.task)
                                    });

                                    const data = await response.json();

                                    if (data.success) {
                                        this.showModal = false;  // Tutup modal
                                        window.location.reload(); // Refresh halaman
                                    } else {
                                        alert(data.message);
                                    }
                                } catch (error) {
                                    console.error('Error:', error);
                                    alert('Failed to create task');
                                }
                            }
                        }">
                            <!-- Modal Trigger Button -->
                            <button @click="showModal = true" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Add New Task
                            </button>

                            <!-- Modal Backdrop -->
                            <div x-show="showModal" 
                                 x-transition.opacity
                                 class="fixed inset-0 bg-black/50 z-40"
                                 @click="showModal = false">
                            </div>

                            <!-- Modal Content -->
                            <div x-show="showModal" 
                                 x-transition
                                 class="fixed inset-0 z-50 flex items-center justify-center p-4">
                                <div class="bg-[#0F2C33] p-6 rounded-lg shadow-xl max-w-md w-full" 
                                     @click.stop>
                                    <h2 class="text-xl font-bold text-[#E6D1B4] mb-4">Add New Task</h2>

                                    <form @submit.prevent="handleSubmit">
                                        <!-- Task Title -->
                                        <div class="mb-4">
                                            <label class="block text-[#E6D1B4]/70 mb-1">Task Title</label>
                                            <input type="text" 
                                                   x-model="task.title"
                                                   class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]"
                                                   required>
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-4">
                                            <label class="block text-[#E6D1B4]/70 mb-1">Description</label>
                                            <textarea x-model="task.description"
                                                      rows="3"
                                                      class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4] resize-none"></textarea>
                                        </div>

                                        <!-- Due Date and Time -->
                                        <div class="grid grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <label class="block text-[#E6D1B4]/70 mb-1">Due Date</label>
                                                <input type="date" 
                                                       x-model="task.due_date"
                                                       class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]"
                                                       required>
                                            </div>
                                            <div>
                                                <label class="block text-[#E6D1B4]/70 mb-1">Due Time</label>
                                                <input type="time" 
                                                       x-model="task.due_time"
                                                       class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]"
                                                       required>
                                            </div>
                                        </div>

                                        <!-- Priority -->
                                        <div class="mb-6">
                                            <label class="block text-[#E6D1B4]/70 mb-1">Priority</label>
                                            <select x-model="task.priority"
                                                    class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4] [&>option]:bg-[#0F2C33]">
                                                <option value="low">Low</option>
                                                <option value="medium">Medium</option>
                                                <option value="high">High</option>
                                            </select>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="flex justify-end space-x-3 mt-6">
                                            <button type="button" 
                                                    @click="showModal = false"
                                                    class="px-4 py-2 text-[#E6D1B4]/70 hover:text-[#E6D1B4]">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                                Add Task
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks List with fixed height and scrolling -->
                    <div class="space-y-4 h-[600px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-[#2E9CA0] scrollbar-track-[#0F2C33]">
                        @foreach($allTasks as $task)
                        <div class="bg-[#0F2C33]/90 backdrop-blur-sm rounded-lg p-4 border border-[#2E9CA0]/30">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-[#E6D1B4] font-medium mb-1">{{ $task->title }}</h3>
                                    @if($task->case_number)
                                        <span class="text-sm text-[#E6D1B4]/70 bg-[#21616A]/30 px-2 py-1 rounded">
                                            Case {{ $task->case_number }}
                                        </span>
                                    @endif
                                </div>
                                <div class="flex flex-col items-end">
                                    <div class="text-sm text-[#E6D1B4]/70">Due Date</div>
                                    <div class="text-[#E6D1B4]">{{ $task->due_date->format('m/d/Y') }}</div>
                                    <div class="mt-2">
                                        @if($task->status === 'overdue')
                                            <span class="text-red-400">⚠ Overdue</span>
                                        @elseif($task->status === 'in_progress')
                                            <span class="text-[#EFA00F]">⏳ In Progress</span>
                                        @elseif($task->status === 'pending')
                                            <span class="text-[#2E9CA0]">⏰ Pending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Calendar Column -->
                <div class="bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                    <h2 class="text-2xl font-bold text-[#E6D1B4] mb-6">Calendar</h2>
                    <div id="calendar"></div>
                </div>
            </div>

            <!-- Task Filters -->
            <div class="bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                <!-- Search Bar -->
                <div class="mb-6">
                    <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
                        <!-- Preserve existing filter if any -->
                        @if(request('filter'))
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                        @endif
                        
                        <div class="flex-1">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search tasks..."
                                   class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-4 py-2 text-[#E6D1B4] placeholder-[#E6D1B4]/50 focus:outline-none focus:border-[#2E9CA0]">
                        </div>
                        <button type="submit" 
                                class="bg-[#2E9CA0] hover:bg-[#2E9CA0]/80 text-[#E6D1B4] px-4 py-2 rounded-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ request()->url() }}{{ request('filter') ? '?filter='.request('filter') : '' }}" 
                               class="bg-[#21616A]/50 hover:bg-[#21616A] text-[#E6D1B4] px-4 py-2 rounded-lg flex items-center">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>

                <nav class="flex space-x-4 mb-6">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 rounded-lg {{ !request('filter') ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70' }}">
                        All Tasks
                    </a>
                    <a href="{{ route('dashboard', ['filter' => 'in_progress']) }}" 
                       class="px-4 py-2 rounded-lg {{ request('filter') === 'in_progress' ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70' }}">
                        In Progress
                    </a>
                    <a href="{{ route('dashboard', ['filter' => 'completed']) }}" 
                       class="px-4 py-2 rounded-lg {{ request('filter') === 'completed' ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70' }}">
                        Completed
                    </a>
                    <a href="{{ route('dashboard', ['filter' => 'pending']) }}" 
                       class="px-4 py-2 rounded-lg {{ request('filter') === 'pending' ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70' }}">
                        Pending
                    </a>
                    <a href="{{ route('dashboard', ['filter' => 'overdue']) }}" 
                       class="px-4 py-2 rounded-lg {{ request('filter') === 'overdue' ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70' }}">
                        Overdue
                    </a>
                </nav>

                <!-- Filtered Tasks List -->
                <div class="space-y-4 mt-6">
                    @forelse($filteredTasks as $task)
                        <div class="task-item bg-[#0F2C33]/90 backdrop-blur-sm rounded-lg p-4 border border-[#2E9CA0]/30">
                            <div class="flex justify-between items-start gap-4">
                                <!-- Checkbox -->
                                <div class="flex-shrink-0">
                                    <label class="neon-checkbox">
                                        <input type="checkbox" 
                                               @if($task->status === 'completed') checked @endif
                                               onchange="updateTaskStatus({{ $task->id }}, this.checked)" />
                                        <div class="neon-checkbox__box">
                                            <div class="neon-checkbox__check">
                                                <svg viewBox="0 0 24 24">
                                                    <path d="M3,12.5l7,7L21,5" fill="none"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <!-- Task Content -->
                                <div class="flex-grow">
                                    <h3 class="text-[#E6D1B4] font-medium mb-1">{{ $task->title }}</h3>
                                    @if($task->case_number)
                                        <span class="text-sm text-[#E6D1B4]/70 bg-[#21616A]/30 px-2 py-1 rounded">
                                            Case {{ $task->case_number }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Right Side Content -->
                                <div class="flex flex-col items-end gap-2">
                                    <div class="text-sm text-[#E6D1B4]/70">Due Date</div>
                                    <div class="text-[#E6D1B4]">{{ $task->due_date->format('m/d/Y') }}</div>
                                    
                                    <!-- Status -->
                                    <div class="mt-2">
                                        @if($task->status === 'overdue')
                                            <span class="text-red-400">⚠ Overdue</span>
                                        @elseif($task->status === 'in_progress')
                                            <span class="text-[#EFA00F]">⏳ In Progress</span>
                                        @elseif($task->status === 'pending')
                                            <span class="text-[#2E9CA0]">⏰ Pending</span>
                                        @endif
                                    </div>

                                    <!-- Three Dots Menu -->
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" 
                                                class="text-[#E6D1B4]/70 hover:text-[#E6D1B4] p-1">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 13a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2zM5 13a1 1 0 100-2 1 1 0 000 2z" />
                                            </svg>
                                        </button>

                                        <div x-show="open" 
                                             @click.away="open = false"
                                             class="task-dropdown">
                                            <a href="{{ route('tasks.edit', $task->id) }}" 
                                               class="text-sm text-[#E6D1B4] hover:bg-[#21616A]/50">
                                                Edit Task
                                            </a>
                                            <button onclick="deleteTask({{ $task->id }})"
                                                    class="text-sm text-red-400 hover:bg-[#21616A]/50">
                                                Delete Task
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-[#E6D1B4]/70">No tasks found for this filter</p>
                        </div>
                    @endforelse

                    <!-- Custom Pagination -->
                    @if($filteredTasks->hasPages())
                        <div class="mt-6 flex justify-center">
                            <div class="flex space-x-2">
                                {{-- Previous Page Link --}}
                                @if($filteredTasks->onFirstPage())
                                    <span class="px-3 py-1 rounded-lg bg-[#21616A]/30 text-[#E6D1B4]/50 cursor-not-allowed">
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $filteredTasks->previousPageUrl() }}" 
                                       class="px-3 py-1 rounded-lg bg-[#21616A] text-[#E6D1B4] hover:bg-[#21616A]/80">
                                        Previous
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach($filteredTasks->getUrlRange(1, $filteredTasks->lastPage()) as $page => $url)
                                    @if($page == $filteredTasks->currentPage())
                                        <span class="px-3 py-1 rounded-lg bg-[#2E9CA0] text-[#E6D1B4]">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" 
                                           class="px-3 py-1 rounded-lg bg-[#21616A] text-[#E6D1B4] hover:bg-[#21616A]/80">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if($filteredTasks->hasMorePages())
                                    <a href="{{ $filteredTasks->nextPageUrl() }}" 
                                       class="px-3 py-1 rounded-lg bg-[#21616A] text-[#E6D1B4] hover:bg-[#21616A]/80">
                                        Next
                                    </a>
                                @else
                                    <span class="px-3 py-1 rounded-lg bg-[#21616A]/30 text-[#E6D1B4]/50 cursor-not-allowed">
                                        Next
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Statistics Section -->
                    <div class="mt-8 border-t border-[#2E9CA0]/30 pt-6">
                        <h3 class="text-xl font-bold text-[#E6D1B4] mb-4">Task Statistics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Tasks by Priority -->
                            <div class="bg-[#0F2C33]/90 rounded-lg p-4 border border-[#2E9CA0]/30">
                                <h4 class="text-[#E6D1B4]/70 mb-2">Tasks by Priority</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-red-400">High Priority</span>
                                        <span class="text-[#E6D1B4]">{{ $highPriorityCount }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-[#EFA00F]">Medium Priority</span>
                                        <span class="text-[#E6D1B4]">{{ $mediumPriorityCount }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-[#2E9CA0]">Low Priority</span>
                                        <span class="text-[#E6D1B4]">{{ $lowPriorityCount }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tasks by Status -->
                            <div class="bg-[#0F2C33]/90 rounded-lg p-4 border border-[#2E9CA0]/30">
                                <h4 class="text-[#E6D1B4]/70 mb-2">Tasks by Status</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-[#2E9CA0]">Pending</span>
                                        <span class="text-[#E6D1B4]">{{ $pendingTasks }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-[#EFA00F]">In Progress</span>
                                        <span class="text-[#E6D1B4]">{{ $inProgressTasks }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-green-400">Completed</span>
                                        <span class="text-[#E6D1B4]">{{ $completedTasks }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-red-400">Overdue</span>
                                        <span class="text-[#E6D1B4]">{{ $overdueTasks }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tasks Due This Week -->
                            <div class="bg-[#0F2C33]/90 rounded-lg p-4 border border-[#2E9CA0]/30">
                                <h4 class="text-[#E6D1B4]/70 mb-2">Due This Week</h4>
                                <div class="text-3xl font-bold text-[#E6D1B4]">{{ $dueThisWeek }}</div>
                                <div class="text-[#E6D1B4]/70 text-sm mt-1">Tasks to complete</div>
                            </div>

                            <!-- Completion Rate -->
                            <div class="bg-[#0F2C33]/90 rounded-lg p-4 border border-[#2E9CA0]/30">
                                <h4 class="text-[#E6D1B4]/70 mb-2">Completion Rate</h4>
                                <div class="text-3xl font-bold text-[#E6D1B4]">{{ $completionRate }}%</div>
                                <div class="text-[#E6D1B4]/70 text-sm mt-1">Tasks completed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Include Task Modal -->
    @include('tasks.partials.task-modal')

    <!-- Calendar Styles -->
    <style>
        .fc {
            --fc-border-color: rgba(46, 156, 160, 0.3);
            --fc-button-text-color: #E6D1B4;
            --fc-button-bg-color: #21616A;
            --fc-button-border-color: rgba(46, 156, 160, 0.3);
            --fc-button-hover-bg-color: #2E9CA0;
            --fc-button-hover-border-color: #EFA00F;
            --fc-button-active-bg-color: #2E9CA0;
            --fc-button-active-border-color: #EFA00F;
            --fc-event-bg-color: rgba(46, 156, 160, 0.3);
            --fc-event-border-color: rgba(46, 156, 160, 0.3);
            --fc-event-text-color: #E6D1B4;
            --fc-event-selected-overlay-color: rgba(0, 0, 0, 0.25);
            --fc-page-bg-color: transparent;
            --fc-neutral-bg-color: transparent;
            --fc-neutral-text-color: #E6D1B4;
            --fc-today-bg-color: rgba(46, 156, 160, 0.1);
        }

        .fc-theme-standard td,
        .fc-theme-standard th {
            border-color: rgba(46, 156, 160, 0.2);
        }

        .fc-daygrid-day-number {
            color: #E6D1B4;
            opacity: 0.8;
        }

        .fc-button {
            backdrop-filter: blur(8px);
        }

        .fc-event {
            cursor: pointer;
            padding: 2px 4px;
            margin: 1px 0;
            background-color: rgba(46, 156, 160, 0.3);
            border: 1px solid rgba(46, 156, 160, 0.3);
        }

        /* Neon Checkbox Styles - Larger Size */
        .neon-checkbox {
            --primary: #2E9CA0;
            --primary-dark: #21616A;
            --primary-light: #88ffdd;
            --size: 32px;  /* Increased from 24px to 32px */
            position: relative;
            width: var(--size);
            height: var(--size);
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
            z-index: 1;
            margin: 4px;  /* Added margin for better spacing */
        }

        .neon-checkbox input {
            display: none;
        }

        .neon-checkbox__box {
            position: absolute;
            inset: 0;
            background: rgba(15, 44, 51, 0.8);
            border-radius: 8px;  /* Increased from 6px to 8px */
            border: 2.5px solid var(--primary-dark);  /* Increased border width */
            transition: all 0.3s ease;
        }

        .neon-checkbox__check {
            position: absolute;
            inset: 3px;  /* Adjusted for larger size */
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .neon-checkbox__check svg {
            width: 85%;  /* Adjusted for better proportion */
            height: 85%;
            stroke: var(--primary);
            stroke-width: 2.5;  /* Increased stroke width */
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .neon-checkbox input:checked ~ .neon-checkbox__box {
            border-color: var(--primary);
            background: rgba(46, 156, 160, 0.2);
            box-shadow: 0 0 20px rgba(46, 156, 160, 0.3);  /* Increased glow effect */
        }

        .neon-checkbox input:checked ~ .neon-checkbox__box .neon-checkbox__check {
            opacity: 1;
            transform: scale(1);
        }

        /* Dropdown Styles - Fixed z-index issue */
        .task-item {
            position: relative;
            z-index: 1;
        }

        .task-item:hover {
            z-index: 2;
        }

        .task-dropdown {
            position: absolute;
            right: 0;
            margin-top: 0.5rem;
            z-index: 100;
            min-width: 12rem;
            padding: 0.5rem 0;
            background-color: rgba(15, 44, 51, 0.95);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(46, 156, 160, 0.3);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                        0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .task-dropdown::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 10px;
            width: 12px;
            height: 12px;
            background-color: rgba(15, 44, 51, 0.95);
            transform: rotate(45deg);
            border-left: 1px solid rgba(46, 156, 160, 0.3);
            border-top: 1px solid rgba(46, 156, 160, 0.3);
        }

        .task-dropdown a,
        .task-dropdown button {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            text-align: left;
            transition: all 0.2s ease;
        }

        .task-dropdown a:hover,
        .task-dropdown button:hover {
            background-color: rgba(33, 97, 106, 0.5);
        }
    </style>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 650,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: ''
                    },
                    events: {!! json_encode($calendarEvents) !!},
                    eventDidMount: function(info) {
                        // Style berdasarkan priority
                        switch (info.event.extendedProps.priority) {
                            case 'high':
                                info.el.style.backgroundColor = 'rgba(239, 68, 68, 0.3)';
                                info.el.style.borderColor = '#EF4444';
                                break;
                            case 'medium':
                                info.el.style.backgroundColor = 'rgba(245, 158, 11, 0.3)';
                                info.el.style.borderColor = '#F59E0B';
                                break;
                            case 'low':
                                info.el.style.backgroundColor = 'rgba(16, 185, 129, 0.3)';
                                info.el.style.borderColor = '#10B981';
                                break;
                        }
                    },
                    dayMaxEvents: 3,
                    eventClick: function(info) {
                        // Popup detail task
                        const popup = document.createElement('div');
                        popup.className = 'fixed inset-0 z-50 flex items-center justify-center';
                        popup.innerHTML = `
                            <div class="fixed inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                            <div class="relative bg-[#0F2C33] p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
                                <h3 class="text-xl font-bold text-[#E6D1B4] mb-2">${info.event.title}</h3>
                                <p class="text-[#E6D1B4]/70 mb-2">Due: ${info.event.start.toLocaleString()}</p>
                                <p class="text-[#E6D1B4]/70 mb-2">Priority: ${info.event.extendedProps.priority}</p>
                                ${info.event.extendedProps.case_number ? 
                                    `<p class="text-[#E6D1B4]/70 mb-4">Case: ${info.event.extendedProps.case_number}</p>` : 
                                    ''}
                                <button class="text-[#E6D1B4]/70 hover:text-[#E6D1B4]" onclick="this.closest('.fixed').remove()">
                                    Close
                                </button>
                            </div>
                        `;
                        document.body.appendChild(popup);
                    },
                    moreLinkClick: function(info) {
                        const popup = document.createElement('div');
                        popup.className = 'fixed inset-0 z-50 flex items-center justify-center';
                        
                        let eventsHtml = info.allSegs.map(seg => {
                            const event = seg.event;
                            return `
                                <div class="border-b border-[#2E9CA0]/30 py-2 last:border-0">
                                    <h4 class="text-[#E6D1B4] font-medium">${event.title}</h4>
                                    <p class="text-[#E6D1B4]/70 text-sm">Due: ${event.start.toLocaleString()}</p>
                                    <p class="text-[#E6D1B4]/70 text-sm">Priority: ${event.extendedProps.priority}</p>
                                </div>
                            `;
                        }).join('');

                        popup.innerHTML = `
                            <div class="fixed inset-0 bg-black/50" onclick="this.parentElement.remove()"></div>
                            <div class="relative bg-[#0F2C33] p-6 rounded-lg shadow-xl max-w-md w-full mx-4">
                                <h3 class="text-xl font-bold text-[#E6D1B4] mb-4">Events for ${info.date.toLocaleDateString()}</h3>
                                <div class="max-h-[60vh] overflow-y-auto">
                                    ${eventsHtml}
                                </div>
                                <button class="mt-4 text-[#E6D1B4]/70 hover:text-[#E6D1B4]" onclick="this.closest('.fixed').remove()">
                                    Close
                                </button>
                            </div>
                        `;
                        document.body.appendChild(popup);
                        return false;
                    }
                });
                calendar.render();
            });
        </script>

        <!-- Alpine.js Script -->
        <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('taskForm', () => ({
                showModal: false,
                async submitTask(event) {
                    const form = event.target;
                    const formData = new FormData(form);
                    
                    try {
                        const response = await fetch('/tasks', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                title: formData.get('title'),
                                case_number: formData.get('case_number'),
                                due_date: `${formData.get('due_date')} ${formData.get('due_time')}`,
                                priority: formData.get('priority')
                            })
                        });

                        if (response.ok) {
                            // Refresh halaman setelah berhasil menambah task
                            window.location.reload();
                        } else {
                            console.error('Failed to create task');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            }));
        });
        </script>

        <script>
        function updateTaskStatus(taskId, isCompleted) {
            // Tambahkan animasi saat checkbox di-klik
            const checkbox = event.target;
            const taskElement = checkbox.closest('.task-item');
            
            fetch(`/tasks/${taskId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    status: isCompleted ? 'completed' : 'pending'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Tambahkan transisi sebelum refresh
                    setTimeout(() => {
                        window.location.reload();
                    }, 300);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                checkbox.checked = !checkbox.checked; // Kembalikan state jika gagal
            });
        }

        function deleteTask(taskId) {
            if (confirm('Are you sure you want to delete this task?')) {
                fetch(`/tasks/${taskId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
        </script>
    @endpush
    </x-app-layout>
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notario</title>
</head>

<body>

</body>

</html>
