{{-- resources/views/admin/users/blocked-users.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Blocked Users</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.all-users') }}">Users</a></li>
                        <li class="breadcrumb-item active">Blocked Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search Form --}}
    <div class="row mb-3">
        <div class="col-12">
            <form method="GET" action="{{ route('admin.blocked-users') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" placeholder="Search by name or email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('admin.blocked-users') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Blocked Users Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Users who have been blocked from the platform ({{ $users->total() }} total)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">User Type</th>
                                    <th scope="col">Blocked Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">{{ $user->name }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info">
                                                {{ $user->user_type === 'service_provider' ? 'Service Provider' : ($user->user_type === 'shop_owner' ? 'Shop Owner' : 'Regular User') }}
                                            </span>
                                        </td>
                                        <td>{{ $user->updated_at->format('Y-m-d') }}</td> {{-- Assuming blocked date is updated_at; adjust if you have a separate field --}}
                                        <td>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-primary me-1">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.users.unblock', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Unblock this user?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="ri-unlock-line"></i> Unblock
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="ri-user-x-line fs-2 mb-2 d-block"></i>
                                                No blocked users found. {{ request('search') ? 'Try adjusting your search.' : 'All users are active.' }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    @if($users->hasPages())
                        <div class="d-flex justify-content-end mt-3">
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection