<div x-data="taskModal" 
     @open-task-modal.window="open = true"
     @close-task-modal.window="open = false"
     x-show="open"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    
    <!-- Modal Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Modal Content -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative w-full max-w-md bg-[#0F2C33] rounded-lg shadow-xl">
            <div class="p-6">
                <h2 class="text-xl font-bold text-[#E6D1B4] mb-4">Add New Task</h2>
                
                <form @submit.prevent="submitTask">
                    <div class="space-y-4">
                        <!-- Task Title -->
                        <div>
                            <label class="block text-[#E6D1B4]/70 mb-1">Task Title</label>
                            <input type="text" 
                                   x-model="form.title"
                                   class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]"
                                   required>
                        </div>

                        <!-- Case Number -->
                        <div>
                            <label class="block text-[#E6D1B4]/70 mb-1">Case Number</label>
                            <input type="text" 
                                   x-model="form.case_number"
                                   class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]">
                        </div>

                        <!-- Due Date and Time -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[#E6D1B4]/70 mb-1">Due Date</label>
                                <input type="date" 
                                       x-model="form.due_date"
                                       class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]"
                                       required>
                            </div>
                            <div>
                                <label class="block text-[#E6D1B4]/70 mb-1">Due Time</label>
                                <input type="time" 
                                       x-model="form.due_time"
                                       class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]"
                                       required>
                            </div>
                        </div>

                        <!-- Priority -->
                        <div>
                            <label class="block text-[#E6D1B4]/70 mb-1">Priority</label>
                            <select x-model="form.priority"
                                    class="w-full bg-[#21616A]/30 border border-[#2E9CA0]/30 rounded-lg px-3 py-2 text-[#E6D1B4]">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" 
                                    @click="open = false"
                                    class="px-4 py-2 text-[#E6D1B4]/70 hover:text-[#E6D1B4]">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Add Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Alpine.js Component -->
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('taskModal', () => ({
        open: false,
        form: {
            title: '',
            case_number: '',
            due_date: new Date().toISOString().split('T')[0],
            due_time: '09:00',
            priority: 'medium'
        },

        async submitTask() {
            try {
                const response = await fetch('/tasks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        ...this.form,
                        due_date: `${this.form.due_date} ${this.form.due_time}`
                    })
                });

                if (response.ok) {
                    window.location.reload();
                }
            } catch (error) {
                console.error('Error creating task:', error);
            }
        }
    }));
});
</script>