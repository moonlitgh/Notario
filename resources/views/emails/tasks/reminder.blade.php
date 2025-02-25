@component('mail::message')
# Task Reminder

Your task "**{{ $task->title }}**" is due {{ $task->due_date->diffForHumans() }}.

**Details:**
- Priority: {{ ucfirst($task->priority) }}
- Status: {{ ucfirst($task->status) }}
- Due Date: {{ $task->due_date->format('M d, Y H:i') }}

@component('mail::button', ['url' => url('/tasks')])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent 