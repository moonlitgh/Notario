<div class="space-y-4">
    @forelse ($tasks as $task)
        <div class="group relative">
            <div class="relative bg-[#0F2C33]/90 backdrop-blur-sm rounded-lg p-4 border border-[#2E9CA0]/30">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 rounded-full
                            @if ($task->priority === 'high') bg-red-400
                            @elseif($task->priority === 'medium') bg-[#EFA00F]
                            @else bg-[#2E9CA0] @endif">
                        </div>
                        <div>
                            <h4 class="text-[#E6D1B4] font-medium {{ $task->status === 'completed' ? 'line-through opacity-50' : '' }}">
                                {{ $task->title }}
                            </h4>
                            <p class="text-sm text-[#E6D1B4]/70">Due: {{ $task->due_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-1 text-xs rounded-full
                            @if ($task->status === 'completed') bg-[#2E9CA0]/10 text-[#2E9CA0]
                            @elseif($task->status === 'in_progress') bg-[#EFA00F]/10 text-[#EFA00F]
                            @else bg-[#21616A]/10 text-[#21616A] @endif">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-8">
            <p class="text-[#E6D1B4]/70">No tasks found</p>
        </div>
    @endforelse

    <!-- View All Tasks Link -->
    <div class="mt-4 text-center">
        <a href="{{ route('tasks.index') }}" 
           class="inline-flex items-center text-[#2E9CA0] hover:text-[#EFA00F] transition-colors duration-200">
            View all tasks
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</div> 