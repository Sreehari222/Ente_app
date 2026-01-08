@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    {{-- PAGE TITLE + REGISTER BUTTON --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="mb-0">Data Entry Operators (DEO)</h4>
        <a href="{{ route('admin.deos.create') }}" class="btn btn-success btn-sm">
            <i class="ri-user-add-line me-1"></i> Register DEO
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
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
                            <td>{{ $deo->areaOperator->name ?? '-' }}</td>
                            <td><span class="badge bg-info">{{ $deo->salesmen_count }}</span></td>
                            <td>{{ $deo->created_at ? $deo->created_at->format('d M Y') : '-' }}</td>
                            <td>
                                <a href="{{ route('admin.deos.show', $deo->id) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('admin.deos.edit', $deo->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.deos.destroy', $deo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this DEO?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No DEOs found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-3">
                {{ $deos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
