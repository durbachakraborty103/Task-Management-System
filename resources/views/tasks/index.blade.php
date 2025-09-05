<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>

    <!-- Add New Task -->
    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Enter task" required placeholder="Enter task title">
        <button type="submit">Add</button>
    </form>

    <ul>
        @foreach($tasks as $task)
            <li>
                {{ $task->title }}
                @if(!$task->completed)
                    <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline">
                        @csrf
                        @method('PUT')
                        <button type="submit">Complete</button>
                    </form>
                @else
                    ✅ Completed
                @endif

                <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>