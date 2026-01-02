{{-- resources/views/admin/users/service-providers.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Service Providers</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.all-users') }}">Users</a></li>
                        <li class="breadcrumb-item active">Service Providers</li>
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
            <form method="GET" action="{{ route('admin.service-providers') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" placeholder="Search by name, email, or service type..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('admin.service-providers') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Service Providers Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Individuals who offer services (electrician, driver, plumber) ({{ isset($users->total) ? $users->total() : $users->count() }} total)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Service Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Joined Date</th>
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
                                            <span class="badge bg-info-subtle text-info">{{ $user->service_type ?? ucfirst(str_replace('_', ' ', $user->user_type)) }}</span>
                                        </td>
                                        <td>
                                            @php $statusClass = match($user->status ?? 'active') { 'active' => 'bg-success', 'pending' => 'bg-warning', 'blocked' => 'bg-danger', default => 'bg-secondary' }; @endphp
                                            <span class="badge {{ $statusClass }} text-{{ Str::before($statusClass, '-')}}">{{ ucfirst($user->status ?? 'active') }}</span>
                                        </td>
                                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-primary me-1">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            <a href="" class="btn btn-sm btn-warning me-1">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            @if(($user->status ?? 'active') === 'blocked')
                                                <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Unblock this user?')">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="ri-unlock-line"></i> Unblock
                                                    </button>
                                                </form>
                                            @else
                                                <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Block this user?')">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="ri-lock-line"></i> Block
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="ri-handshake-line fs-2 mb-2 d-block"></i>
                                                No service providers found. {{ request('search') ? 'Try adjusting your search.' : 'Start by approving providers.' }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    @if(method_exists($users, 'links'))
                        <div class="d-flex justify-content-end mt-3">
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection