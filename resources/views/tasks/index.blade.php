<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <x-app-layout>
        <div x-data="taskApp">
            <div class="relative min-h-screen bg-[#0F2C33]">
                <!-- Background Effects -->
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
                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="mb-8 relative">
                                <div
                                    class="absolute -inset-0.5 bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] rounded-lg blur opacity-30">
                                </div>
                                <div
                                    class="relative bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-4 border border-[#2E9CA0]/30">
                                    <p class="text-[#E6D1B4]">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Header Section -->
                        <div class="flex justify-between items-center mb-8">
                            <h1 class="text-4xl font-bold text-[#E6D1B4]">Tasks</h1>
                            <button @click="openModal()" type="button"
                                class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] text-[#0F2C33] font-semibold hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                New Task
                            </button>
                        </div>

                        <!-- Filters -->
                        <div class="border-b border-[#2E9CA0]/30 mb-4">
                            <nav class="flex space-x-4">
                                <a href="{{ route('tasks.index') }}"
                                    class="px-3 py-2 text-sm font-medium rounded-md {{ !request('status') ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70 hover:text-[#E6D1B4]' }}">
                                    All Tasks
                                </a>
                                <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}"
                                    class="px-3 py-2 text-sm font-medium rounded-md {{ request('status') === 'in_progress' ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70 hover:text-[#E6D1B4]' }}">
                                    In Progress
                                </a>
                                <a href="{{ route('tasks.index', ['status' => 'completed']) }}"
                                    class="px-3 py-2 text-sm font-medium rounded-md {{ request('status') === 'completed' ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70 hover:text-[#E6D1B4]' }}">
                                    Completed
                                </a>
                                <a href="{{ route('tasks.index', ['status' => 'pending']) }}"
                                    class="px-3 py-2 text-sm font-medium rounded-md {{ request('status') === 'pending' ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70 hover:text-[#E6D1B4]' }}">
                                    Pending
                                </a>
                                <a href="{{ route('tasks.index', ['status' => 'overdue']) }}"
                                    class="px-3 py-2 text-sm font-medium rounded-md {{ request('status') === 'overdue' ? 'bg-[#21616A] text-[#E6D1B4]' : 'text-[#E6D1B4]/70 hover:text-[#E6D1B4]' }}">
                                    Overdue
                                </a>
                            </nav>
                        </div>

                        <!-- Tasks List -->
                        <div class="space-y-4">
                            @forelse ($tasks as $task)
                                <div class="group relative">
                                    <div
                                        class="relative bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <button
                                                    @click="updateTaskStatus({{ $task->id }}, '{{ $task->status === 'completed' ? 'pending' : 'completed' }}')"
                                                    class="w-5 h-5 rounded border-2 {{ $task->status === 'completed' ? 'bg-[#2E9CA0] border-[#2E9CA0]' : 'border-[#2E9CA0]/50' }}">
                                                    @if ($task->status === 'completed')
                                                        <svg class="w-3 h-3 mx-auto text-[#E6D1B4]" fill="currentColor"
                                                            viewBox="0 0 12 12">
                                                            <path
                                                                d="M3.707 5.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414L5 6.586 3.707 5.293z" />
                                                        </svg>
                                                    @endif
                                                </button>
                                                <div>
                                                    <h4
                                                        class="text-lg font-medium {{ $task->status === 'completed' ? 'text-[#E6D1B4]/50 line-through' : 'text-[#E6D1B4]' }}">
                                                        {{ $task->title }}
                                                    </h4>
                                                    <p
                                                        class="text-[#E6D1B4]/70 {{ $task->status === 'completed' ? 'line-through' : '' }}">
                                                        {{ $task->description }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <!-- Priority Badge -->
                                                <span
                                                    class="px-3 py-1 text-sm rounded-full
                                                    @if ($task->priority === 'high') bg-red-500/10 text-red-400
                                                    @elseif($task->priority === 'medium') bg-[#EFA00F]/10 text-[#EFA00F]
                                                    @else bg-[#2E9CA0]/10 text-[#2E9CA0] @endif">
                                                    {{ ucfirst($task->priority) }} Priority
                                                </span>

                                                <!-- Status Badge -->
                                                <span
                                                    class="px-3 py-1 text-sm rounded-full
                                                    @if ($task->status === 'completed') bg-[#2E9CA0]/10 text-[#2E9CA0]
                                                    @elseif($task->status === 'in_progress') bg-[#EFA00F]/10 text-[#EFA00F]
                                                    @else bg-[#21616A]/10 text-[#21616A] @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>

                                                <!-- Due Date -->
                                                <span class="text-[#E6D1B4]/70">Due:
                                                    {{ $task->due_date->format('M d, Y') }}</span>

                                                <!-- Task Menu -->
                                                <div class="relative" x-data="{ menuOpen: false }">
                                                    <button @click="menuOpen = !menuOpen"
                                                        class="text-[#E6D1B4]/70 hover:text-[#E6D1B4] transition-colors duration-200">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                        </svg>
                                                    </button>

                                                    <!-- Task Menu Dropdown -->
                                                    <div x-show="menuOpen" @click.away="menuOpen = false"
                                                        style="position: absolute; right: 0; bottom: 100%; z-index: 9999;"
                                                        class="mb-2 w-48 rounded-lg bg-[#0F2C33] border border-[#2E9CA0]/30">
                                                        <div class="py-1 relative z-50">
                                                            <button @click="editTask({{ $task }})"
                                                                class="block w-full text-left px-4 py-2 text-sm text-[#E6D1B4]/70 hover:text-[#E6D1B4] hover:bg-[#21616A] transition-colors duration-200">
                                                                Edit Task
                                                            </button>
                                                            <form action="{{ route('tasks.destroy', $task) }}"
                                                                method="POST" class="relative z-50">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:text-red-300 hover:bg-[#21616A] transition-colors duration-200">
                                                                    Delete Task
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <h3 class="text-xl text-[#E6D1B4]/70 mb-4">No tasks found</h3>
                                    <button @click="openModal()" type="button"
                                        class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] text-[#0F2C33] font-semibold hover:scale-105 transition-all duration-200">
                                        Create your first task
                                    </button>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if ($tasks->hasPages())
                            <div class="mt-8">
                                {{ $tasks->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Task Modal -->
            <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">

                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

                <!-- Modal Content -->
                <div class="relative min-h-screen flex items-center justify-center p-4">
                    <div class="relative w-full max-w-md">
                        <!-- Gradient Border Effect -->
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] rounded-lg blur opacity-30">
                        </div>

                        <!-- Modal Content -->
                        <div class="relative bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg border border-[#2E9CA0]/30">
                            <!-- Modal Header -->
                            <div class="border-b border-[#2E9CA0]/30 p-4">
                                <h3 class="text-xl font-semibold text-[#E6D1B4]"
                                    x-text="isEditing ? 'Edit Task' : 'Create New Task'"></h3>
                            </div>

                            <!-- Modal Body -->
                            <form @submit.prevent="isEditing ? updateTask() : createTask()">
                                <div class="p-4 space-y-4">
                                    <!-- Title -->
                                    <div>
                                        <label class="block text-[#E6D1B4]/70 mb-2">Title</label>
                                        <input type="text" x-model="form.title"
                                            class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 text-[#E6D1B4] rounded-lg px-4 py-2 focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F] placeholder-[#E6D1B4]/30"
                                            required>
                                    </div>

                                    <!-- Description -->
                                    <div>
                                        <label class="block text-[#E6D1B4]/70 mb-2">Description</label>
                                        <textarea x-model="form.description"
                                            class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 text-[#E6D1B4] rounded-lg px-4 py-2 focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F] placeholder-[#E6D1B4]/30"
                                            rows="3"></textarea>
                                    </div>

                                    <!-- Priority -->
                                    <div>
                                        <label class="block text-[#E6D1B4]/70 mb-2">Priority</label>
                                        <select x-model="form.priority"
                                            class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 text-[#E6D1B4] rounded-lg px-4 py-2 focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F]">
                                            <option value="low" class="bg-[#0F2C33]">Low</option>
                                            <option value="medium" class="bg-[#0F2C33]">Medium</option>
                                            <option value="high" class="bg-[#0F2C33]">High</option>
                                        </select>
                                    </div>

                                    <!-- Repetition -->
                                    <div>
                                        <label class="block text-[#E6D1B4]/70 mb-2">Repetition</label>
                                        <select x-model="form.repetition"
                                            class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 text-[#E6D1B4] rounded-lg px-4 py-2 focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F]">
                                            <option value="none" class="bg-[#0F2C33]">No Repeat</option>
                                            <option value="weekly" class="bg-[#0F2C33]">Weekly</option>
                                            <option value="monthly" class="bg-[#0F2C33]">Monthly</option>
                                            <option value="yearly" class="bg-[#0F2C33]">Yearly</option>
                                        </select>
                                    </div>

                                    <!-- Due Date -->
                                    <div>
                                        <label class="block text-[#E6D1B4]/70 mb-2">Due Date</label>
                                        <input type="date" x-model="form.due_date"
                                            class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 text-[#E6D1B4] rounded-lg px-4 py-2 focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F]"
                                            required>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="border-t border-[#2E9CA0]/30 p-4 flex justify-end space-x-3">
                                    <button type="button" @click="showModal = false"
                                        class="px-4 py-2 text-[#E6D1B4]/70 hover:text-[#E6D1B4] transition-colors duration-200">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] text-[#0F2C33] font-semibold rounded-lg hover:scale-105 transition-all duration-200">
                                        <span x-text="isEditing ? 'Update Task' : 'Create Task'"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alpine.js Component -->
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('taskApp', () => ({
                    showModal: false,
                    isEditing: false,
                    taskId: null,
                    form: {
                        title: '',
                        description: '',
                        priority: 'medium',
                        repetition: 'none',
                        due_date: new Date().toISOString().split('T')[0]
                    },

                    openModal() {
                        this.showModal = true;
                    },

                    closeModal() {
                        this.showModal = false;
                        this.resetForm();
                    },

                    editTask(task) {
                        this.isEditing = true;
                        this.taskId = task.id;
                        this.form = {
                            title: task.title,
                            description: task.description || '',
                            priority: task.priority,
                            repetition: task.repetition || 'none',
                            due_date: task.due_date.split('T')[0]
                        };
                        this.showModal = true;
                    },

                    resetForm() {
                        this.isEditing = false;
                        this.taskId = null;
                        this.form = {
                            title: '',
                            description: '',
                            priority: 'medium',
                            repetition: 'none',
                            due_date: new Date().toISOString().split('T')[0]
                        };
                    },

                    async updateTaskStatus(taskId, newStatus) {
                        try {
                            const response = await fetch(`/tasks/${taskId}/status`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    status: newStatus
                                })
                            });

                            if (response.ok) {
                                // Reload halaman untuk memperbarui tampilan
                                window.location.reload();
                            }
                        } catch (error) {
                            console.error('Error updating task status:', error);
                        }
                    },

                    async createTask() {
                        try {
                            const response = await fetch('/tasks', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify(this.form)
                            });

                            if (response.ok) {
                                window.location.reload();
                            }
                        } catch (error) {
                            console.error('Error creating task:', error);
                        }
                    },

                    async updateTask() {
                        try {
                            const response = await fetch(`/tasks/${this.taskId}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify(this.form)
                            });

                            if (response.ok) {
                                window.location.reload();
                            }
                        } catch (error) {
                            console.error('Error updating task:', error);
                        }
                    }
                }));
            });
        </script>
    </x-app-layout>

</body>

</html>
