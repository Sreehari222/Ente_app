@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Salesmen List</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>DEO</th>
                        <th>Area Operator</th>
                        <th>Registered Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($salesmen as $index => $salesman)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $salesman->name }}</td>
                        <td>{{ $salesman->email }}</td>
                        <td>{{ $salesman->deo->name ?? '-' }}</td>
                        <td>{{ $salesman->areaOperator->name ?? '-' }}</td>
                        <td>{{ $salesman->created_at?->format('d M Y') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.salesmen.edit', $salesman->id) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.salesmen.destroy', $salesman->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete this salesman?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No Salesmen Found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
