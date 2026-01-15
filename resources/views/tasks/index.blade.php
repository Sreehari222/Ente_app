@extends(auth()->user()->role === 'salesman' ? 'layouts.salesman' : (auth()->user()->role === 'deo' ? 'layouts.deo' : 'layouts.area_operator'))

@section('content')
<div class="container">
    <h1>Tasks</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'area_operator')
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Priority</th>
                <th>Status</th>
                <th>DEO</th>
                <th>Salesman</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->deo?->name ?? 'N/A' }}</td>
                    <td>{{ $task->salesman?->name ?? 'N/A' }}</td>
                    <td>{{ $task->creator?->name ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
