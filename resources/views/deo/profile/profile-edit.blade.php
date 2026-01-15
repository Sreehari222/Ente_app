@extends('layouts.deo')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Edit My Profile</h4>
        <a href="{{ route('deo.profile') }}" class="btn btn-outline-secondary">
            <i class="ri-arrow-left-line"></i> Back
        </a>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- LEFT COLUMN --}}
            <div class="col-lg-4">

                {{-- Profile Photo --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <img
                            src="{{ auth()->user()->profile_photo
                                ? asset('storage/'.auth()->user()->profile_photo)
                                : asset('public/images/users/avatar-1.jpg') }}"
                            class="rounded-circle mb-3"
                            width="120"
                            height="120"
                        >

                        <h6 class="mb-1">{{ auth()->user()->name }}</h6>
                        <small class="text-muted text-uppercase">{{ auth()->user()->role }}</small>

                        <hr>

                        <div class="mb-2 text-start">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" name="profile_photo" class="form-control">
                        </div>

                        <div class="mb-2 text-start">
                            <label class="form-label">Cover Photo</label>
                            <input type="file" name="cover_photo" class="form-control">
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN --}}
            <div class="col-lg-8">

                {{-- Basic Info --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light fw-semibold">Basic Information</div>
                    <div class="card-body row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', auth()->user()->name) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control"
                                value="{{ old('phone_number', auth()->user()->phone_number) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', auth()->user()->address) }}">
                        </div>

                    </div>
                </div>

                {{-- Banking Info --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light fw-semibold">Bank Details</div>
                    <div class="card-body row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="account_number" class="form-control"
                                value="{{ old('account_number', auth()->user()->account_number) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">IFSC Code</label>
                            <input type="text" name="ifsc_code" class="form-control"
                                value="{{ old('ifsc_code', auth()->user()->ifsc_code) }}">
                        </div>

                    </div>
                </div>

                {{-- System Info (Read-only) --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-light fw-semibold">System Information</div>
                    <div class="card-body row g-3">

                        <div class="col-md-4">
                            <label class="form-label">User ID</label>
                            <input type="text" class="form-control" value="{{ auth()->id() }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Role</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->role }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Area Operator ID</label>
                            <input type="text" class="form-control"
                                value="{{ auth()->user()->area_operator_id ?? '-' }}" readonly>
                        </div>

                    </div>
                </div>

                {{-- Submit --}}
                <div class="text-end">
                    <button class="btn btn-primary px-4">
                        <i class="ri-save-line"></i> Update Profile
                    </button>
                </div>

            </div>

        </div>
    </form>
</div>
@endsection
