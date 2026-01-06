@extends('layouts.admin')

@section('title', 'Verification Requests')

@section('content')

    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Vendor Verification Requests</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Verification Requests</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pending Vendor Approvals</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Requested Role</th>
                                    <th>ID Proof</th>
                                    <th>Submitted On</th>
                                    <th>Status</th>
                                    <th width="180">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($vendors as $vendor)
                                    <tr>
                                        {{-- User --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $vendor->photo ? Storage::url($vendor->photo) : asset('assets/images/users/avatar-1.jpg') }}"
                                                    class="rounded-circle avatar-xs me-2" alt="{{ $vendor->shop_name }}">
                                                <span>{{ $vendor->shop_name }}</span>
                                            </div>
                                        </td>

                                        {{-- Email --}}
                                        <td>{{ $vendor->email ?? 'N/A' }}</td>

                                        {{-- Requested Role --}}
                                        <td class="text-capitalize">
                                            Vendor
                                        </td>

                                        {{-- Document --}}
                                        <td>
                                            @if ($vendor->photo)
                                                <a href="{{ Storage::url($vendor->photo) }}" target="_blank"
                                                    class="btn btn-sm btn-info">
                                                    View
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>

                                        {{-- Submitted On --}}
                                        <td>{{ $vendor->created_at->format('d M Y') }}</td>

                                        {{-- Status --}}
                                        <td>
                                            @if ($vendor->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($vendor->status === 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        {{-- Actions --}}
                                        <td class="text-center">
                                            {{-- View --}}
                                            <a href="{{ route('admin.verification.show', $vendor->id) }}"
                                                class="btn btn-sm btn-info me-1" title="View Vendor">
                                                <i class="ri-eye-line"></i>
                                            </a>

                                            @if ($vendor->status === 'pending')
                                                {{-- Approve --}}
                                                <form action="{{ route('admin.verification.approve', $vendor->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success me-1"
                                                        title="Approve" onclick="return confirm('Approve this vendor?')">
                                                        <i class="ri-check-line"></i>
                                                    </button>
                                                </form>

                                                {{-- Reject --}}
                                                <form action="{{ route('admin.verification.reject', $vendor->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Reject"
                                                        onclick="return confirm('Reject this vendor?')">
                                                        <i class="ri-close-line"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-secondary">No Action</span>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            No verification requests found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $vendors->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
