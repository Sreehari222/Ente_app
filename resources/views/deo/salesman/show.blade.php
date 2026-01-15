@extends('layouts.deo')

@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="row mb-4 align-items-center">
            <div class="col">
                <h4 class="fw-bold mb-1">Salesman Details</h4>
                <p class="text-muted mb-0">View salesman information</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('salesmen.index') }}" class="btn btn-outline-secondary">
                    <i class="ri-arrow-left-line"></i> Back
                </a>
            </div>
        </div>

        <div class="row">

            <!-- Left: Profile -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">

                        <img src="{{ $salesman->profile_photo ? asset('storage/' . $salesman->profile_photo) : asset('images/users/avatar-1.jpg') }}"
                            class="rounded-circle mb-3" width="120" height="120" alt="Profile Photo">

                        <h5 class="fw-bold mb-0">{{ $salesman->name }}</h5>
                        <p class="text-muted mb-2">{{ $salesman->email }}</p>

                        <span
                            class="badge
                        {{ ($salesman->status ?? 'active') == 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($salesman->status ?? 'active') }}
                        </span>

                    </div>
                </div>
            </div>

            <!-- Right: Details -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h6 class="fw-semibold mb-3">Basic Information</h6>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <small class="text-muted">Phone Number</small>
                                <div>{{ $salesman->phone_number ?? '-' }}</div>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">Address</small>
                                <div>{{ $salesman->address ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <small class="text-muted">Account Number</small>
                                <div>{{ $salesman->account_number ?? '-' }}</div>
                            </div>

                            <div class="col-md-6">
                                <small class="text-muted">IFSC Code</small>
                                <div>{{ $salesman->ifsc_code ?? '-' }}</div>
                            </div>
                        </div>

                        <hr>

                        <h6 class="fw-semibold mb-3">System Information</h6>

                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted">Role</small>
                                <div>{{ ucfirst($salesman->role) }}</div>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted">Joined At</small>
                                <div>{{ $salesman->created_at->format('d M Y') }}</div>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted">Last Login</small>
                                <div>
                                    {{ $salesman->last_login_at ? \Carbon\Carbon::parse($salesman->last_login_at)->format('d M Y, h:i A') : '-' }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- Vendors List -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0">Vendors Added by {{ $salesman->name }}</h5>
                            <span class="badge bg-primary">{{ $vendors->count() }} Vendors</span>
                        </div>

                        @if ($vendors->count())
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Shop Name</th>
                                            <th>Owner</th>
                                            <th>Mobile</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $index => $vendor)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td class="fw-semibold">{{ $vendor->shop_name }}</td>
                                                <td>{{ $vendor->owner_name }}</td>
                                                <td>{{ $vendor->mobile }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $vendor->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ ucfirst($vendor->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('vendors.show', $vendor->id) }}"
                                                            class="btn btn-outline-primary">
                                                            <i class="ri-eye-line"></i>
                                                        </a>

                                                        <a href="{{ route('vendors.edit', $vendor->id) }}"
                                                            class="btn btn-outline-warning">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="ri-store-2-line fs-1 text-muted"></i>
                                <p class="text-muted mb-0 mt-2">No vendors added by this salesman.</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
