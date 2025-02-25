<x-app-layout>
    <div class="relative min-h-screen bg-[#0F2C33]">
        <!-- Background Gradients -->
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-20 left-1/4 w-[500px] h-[500px] bg-[#21616A] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob"></div>
            <div class="absolute top-1/3 -right-20 w-[600px] h-[600px] bg-[#2E9CA0] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-20 left-1/3 w-[550px] h-[550px] bg-[#EFA00F] rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 py-12">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-[#0F2C33]/80 backdrop-blur-sm rounded-lg p-6 border border-[#2E9CA0]/30">
                    <h2 class="text-2xl font-bold text-[#E6D1B4] mb-6">Edit Task</h2>

                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Task Title -->
                        <div class="mb-4">
                            <label class="block text-[#E6D1B4]/70 mb-1">Task Title</label>
                            <input type="text" 
                                   name="title"
                                   value="{{ old('title', $task->title) }}"
                                   class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]"
                                   required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="block text-[#E6D1B4]/70 mb-1">Description</label>
                            <textarea name="description"
                                      rows="3"
                                      class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4] resize-none">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <label class="block text-[#E6D1B4]/70 mb-1">Due Date</label>
                            <input type="datetime-local" 
                                   name="due_date"
                                   value="{{ old('due_date', $task->due_date->format('Y-m-d\TH:i')) }}"
                                   class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]"
                                   required>
                        </div>

                        <!-- Priority -->
                        <div class="mb-6">
                            <label class="block text-[#E6D1B4]/70 mb-1">Priority</label>
                            <select name="priority"
                                    class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4] [&>option]:bg-[#0F2C33]">
                                <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('dashboard') }}" 
                               class="px-4 py-2 text-[#E6D1B4]/70 hover:text-[#E6D1B4]">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-[#2E9CA0] text-white rounded-lg hover:bg-[#21616A]">
                                Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 