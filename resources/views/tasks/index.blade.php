<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Task Manager</h1>

        <!-- Add New Task Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Your Tasks</h2>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
        </div>

        <!-- Filter Form -->
        @include('tasks.partials.filter')

        <!-- Tasks List -->
        <div class="card">
            <div class="card-body">
                @if($tasks->count())
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Priority</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>
                                            <span class="badge bg-{{ $task->priority === 'high' ? 'danger' : ($task->priority === 'medium' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($task->due_date)
                                                {{ \Carbon\Carbon::parse($task->due_date)->format('M j, Y') }}
                                            @else
                                                No due date
                                            @endif
                                        </td>
                                        <td>
                                            @if($task->completed)
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-info">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            
                                            <!-- Complete Button -->
                                            @if(!$task->completed)
                                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Complete</button>
                                                </form>
                                            @else
                                                <!-- Mark Incomplete Button -->
                                                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="completed" value="0">
                                                    <button type="submit" class="btn btn-sm btn-warning">Mark Incomplete</button>
                                                </form>
                                            @endif
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $tasks->links() }}
                    </div>
                @else
                    <p class="text-center">No tasks found. <a href="{{ route('tasks.create') }}">Create your first task</a></p>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>