{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">All Users</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Admin</a>
                        </li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search --}}
    <div class="row mb-3">
        <div class="col-12">
            <form method="GET" action="{{ route('admin.users') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search"
                               placeholder="Search by name or email"
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary">Search</button>
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Users Grid --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">All Users ({{ $users->total() }})</h5>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        @forelse ($users as $user)
                            <div class="col-xl-4 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-1">{{ $user->name }}</h6>
                                        <p class="text-muted small mb-1">{{ $user->email }}</p>

                                        <span class="badge bg-info-subtle text-info">
                                            {{ ucfirst($user->user_type) }}
                                        </span>

                                        <div class="mt-3 d-flex gap-2">
                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                               class="btn btn-sm btn-primary">View</a>

                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="btn btn-sm btn-warning">Edit</a>

                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h5 class="text-muted">No users found</h5>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if ($users->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
