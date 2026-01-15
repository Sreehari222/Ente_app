@extends('layouts.deo')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">My Profile</h4>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
            <i class="ri-arrow-left-line"></i> Back
        </a>
    </div>

    <div class="row g-4">

        {{-- LEFT : Profile Card --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">

                    {{-- Profile Photo --}}
                    <img
                        src="{{ auth()->user()->profile_photo
                            ? asset('storage/' . auth()->user()->profile_photo)
                            : asset('images/users/avatar-1.jpg') }}"
                        class="rounded-circle mb-3"
                        width="120"
                        height="120"
                        alt="Profile Photo">

                    <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted mb-2">{{ auth()->user()->email }}</p>

                    <span class="badge bg-primary text-uppercase">
                        {{ auth()->user()->role }}
                    </span>

                    <hr>

                    <div class="text-start small">
                        <p><strong>Last Login:</strong><br>
                            {{ auth()->user()->last_login_at
                                ? \Carbon\Carbon::parse(auth()->user()->last_login_at)->format('d M Y, h:i A')
                                : '-' }}
                        </p>

                        <p><strong>Last Logout:</strong><br>
                            {{ auth()->user()->last_logout_at
                                ? \Carbon\Carbon::parse(auth()->user()->last_logout_at)->format('d M Y, h:i A')
                                : '-' }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        {{-- RIGHT : Details --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">

                    {{-- Basic Info --}}
                    <h6 class="fw-semibold mb-3">Basic Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Name</small>
                            <div>{{ auth()->user()->name ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Email</small>
                            <div>{{ auth()->user()->email ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Phone Number</small>
                            <div>{{ auth()->user()->phone_number ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Address</small>
                            <div>{{ auth()->user()->address ?? '-' }}</div>
                        </div>
                    </div>

                    <hr>

                    {{-- Financial Info --}}
                    <h6 class="fw-semibold mb-3">Financial Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Account Number</small>
                            <div>{{ auth()->user()->account_number ?? '-' }}</div>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">IFSC Code</small>
                            <div>{{ auth()->user()->ifsc_code ?? '-' }}</div>
                        </div>
                    </div>

                    <hr>

                    {{-- System Info --}}
                    <h6 class="fw-semibold mb-3">System Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <small class="text-muted">Role</small>
                            <div class="text-uppercase">{{ auth()->user()->role }}</div>
                        </div>

                        <div class="col-md-4">
                            <small class="text-muted">Area Operator ID</small>
                            <div>{{ auth()->user()->area_operator_id ?? '-' }}</div>
                        </div>

                        <div class="col-md-4">
                            <small class="text-muted">DEO ID</small>
                            <div>{{ auth()->id() ?? '-' }}</div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">Created At</small>
                            <div>{{ auth()->user()->created_at?->format('d M Y') }}</div>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted">Updated At</small>
                            <div>{{ auth()->user()->updated_at?->format('d M Y') }}</div>
                        </div>
                    </div>

                    <hr>

                    {{-- Actions --}}
                    <div class="text-end">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
                            <i class="ri-edit-line"></i> Edit Profile
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
