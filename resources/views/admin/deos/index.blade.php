@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">Data Entry Operators (DEO)</h4>

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
                        <th>Area Operator</th>
                        <th>No. of Salesmen</th>
                        <th>Registered Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($deos as $index => $deo)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $deo->name }}</td>
                        <td>{{ $deo->email }}</td>
                        <td>
                            {{ $deo->areaOperator->name ?? '-' }}
                        </td>
                        <td>
                            <span class="badge bg-info">
                                {{ $deo->salesmen_count }}
                            </span>
                        </td>
                        <td>
                            {{ $deo->created_at ? $deo->created_at->format('d M Y') : '-' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.deos.show', $deo->id) }}"
                               class="btn btn-sm btn-primary">
                                View
                            </a>

                            <a href="{{ route('admin.deos.edit', $deo->id) }}"
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.deos.destroy', $deo->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this DEO?')"
                                        class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No DEOs found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
