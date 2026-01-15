@extends('layouts.area_operator')

@section('title', 'DEOs')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>DEO List</h4>

            <a href="{{ route('area.deo.create') }}" class="btn btn-primary">
                <i class="ri-user-add-line"></i> Add DEO
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deos as $deo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $deo->name }}</td>
                                <td>{{ $deo->email }}</td>
                                <td>{{ $deo->phone_number ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('area.deo.show', $deo->id) }}" class="btn btn-sm btn-info">
                                        <i class="ri-eye-line"></i>
                                        View
                                    </a>

                                    <a href="{{ route('area.deo.edit', $deo->id) }}" class="btn btn-sm btn-warning">
                                        <i class="ri-edit-line"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('area.deo.destroy', $deo->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this DEO?')">
                                            <i class="ri-delete-bin-line"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
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
