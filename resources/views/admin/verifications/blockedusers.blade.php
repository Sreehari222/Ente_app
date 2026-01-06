@extends('layouts.admin')

@section('title', 'Blocked Users')

@section('content')

    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Blocked Users</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blocked Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Users with Rejected Status</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Shop / Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Main Category</th>
                                    <th>Category</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                    <th>Actions</th> {{-- Added --}}
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($blockedVendors as $vendor)
                                    <tr>
                                        <td>{{ $vendor->shop_name ?? $vendor->owner_name }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->mobile }}</td>
                                        <td>{{ $vendor->mainCategory?->name ?? '-' }}</td>
                                        <td>{{ $vendor->category?->name ?? '-' }}</td>
                                        <td>{{ $vendor->plan?->title ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-danger">{{ ucfirst($vendor->status) }}</span>
                                        </td>
                                        <td class="text-center">

    {{-- View --}}
    <a href="{{ route('admin.blocked-users.show', $vendor->id) }}"
       class="btn btn-sm btn-info me-1"
       title="View Vendor">
        <i class="ri-eye-line"></i>
    </a>

    {{-- Approve --}}
    <form action="{{ route('admin.blocked-users.approve', $vendor->id) }}"
          method="POST" class="d-inline">
        @csrf
        <button type="submit"
                class="btn btn-sm btn-success"
                title="Approve"
                onclick="return confirm('Are you sure you want to approve this vendor?')">
            <i class="ri-check-line"></i>
        </button>
    </form>

</td>
<Fieldset></Fieldset>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No blocked users found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $blockedVendors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
