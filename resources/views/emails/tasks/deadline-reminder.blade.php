@component('mail::message')
# Task Deadline Reminder

Your task "**{{ $task->title }}**" is {{ $task->due_date->diffForHumans() }}.

**Task Details:**
- Status: {{ ucfirst($task->status) }}
- Priority: {{ ucfirst($task->priority) }}
- Due Date: {{ $task->due_date->format('M d, Y') }}

@component('mail::button', ['url' => route('tasks.show', $task->id)])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent 