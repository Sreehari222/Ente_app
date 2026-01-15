@extends('layouts.deo')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">Pending Vendors</h4>
                <p class="text-muted mb-0">Vendors waiting for approval</p>
            </div>
            <span class="badge rounded-pill bg-primary fs-6 px-3 py-2">
                {{ $vendors->count() }} Pending
            </span>
        </div>
    </div>

    @if ($vendors->count())
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-hover mb-0">
                        <thead class="bg-light text-uppercase small">
                            <tr>
                                <th class="text-center" style="width:60px;">#</th>
                                <th>Shop Name</th>
                                <th>Owner</th>
                                <th>Salesman</th>
                                <th>Mobile</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $index => $vendor)
                                <tr class="vendor-row">
                                    <td class="text-center fw-semibold">{{ $index + 1 }}</td>

                                    <td>
                                        <div class="fw-semibold">{{ $vendor->shop_name }}</div>
                                        <small class="text-muted">Vendor ID: #{{ $vendor->id }}</small>
                                    </td>

                                    <td>{{ $vendor->owner_name }}</td>
                                    <td>{{ $vendor->salesman->name ?? '-' }}</td>
                                    <td>{{ $vendor->mobile }}</td>

                                    <td class="text-center">
                                        @php
                                            $statusClass = match ($vendor->status) {
                                                'pending' => 'warning',
                                                'active' => 'success',
                                                'rejected' => 'danger',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge rounded-pill bg-{{ $statusClass }} px-3 py-2">
                                            {{ ucfirst($vendor->status) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <!-- View -->
                                            <a href="{{ route('deo.vendors.show', $vendor->id) }}"
                                               class="btn btn-sm btn-soft-primary"
                                               title="View">
                                                <i class="ri-eye-line"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('deo.vendors.edit', $vendor->id) }}"
                                               class="btn btn-sm btn-soft-warning"
                                               title="Edit">
                                                <i class="ri-pencil-line"></i>
                                            </a>

                                            <!-- Approve -->
                                            @if ($vendor->status !== 'approved')
                                                <form action="{{ route('vendors.approve', $vendor->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-soft-success"
                                                            title="Approve"
                                                            onclick="return confirm('Approve this vendor?')">
                                                        <i class="ri-check-line"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-soft-success" disabled>
                                                    <i class="ri-check-double-line"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="ri-store-2-line fs-1 text-muted mb-3"></i>
                <h6 class="fw-semibold">No Pending Vendors</h6>
                <p class="text-muted mb-0">
                    All vendors under your salesmen are approved 🎉
                </p>
            </div>
        </div>
    @endif

</div>

{{-- UI Enhancements --}}
<style>
    .vendor-row:hover {
        background-color: rgba(0, 0, 0, 0.015);
        transition: 0.2s ease-in-out;
    }

    .btn-soft-primary {
        background-color: rgba(13,110,253,.1);
        color: #0d6efd;
        border: none;
    }

    .btn-soft-warning {
        background-color: rgba(255,193,7,.15);
        color: #ffc107;
        border: none;
    }

    .btn-soft-success {
        background-color: rgba(25,135,84,.15);
        color: #198754;
        border: none;
    }

    .btn-soft-primary:hover,
    .btn-soft-warning:hover,
    .btn-soft-success:hover {
        opacity: .85;
    }
</style>
@endsection
