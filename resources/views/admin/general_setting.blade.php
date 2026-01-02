{{-- resources/views/admin/settings/general.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy settings data (in real app, fetch from DB or config)
    $settings = (object) [
        'app_name' => 'Panchayath Connect',
        'contact_email' => 'support@panchayathconnect.com',
        'contact_phone' => '+91 40 1234 5678',
        'app_address' => 'Main Administrative Office, Village Square, Panchayath Locality, Pin Code - 500001',
        'app_status' => true, // Live
        'logo_path' => asset('assets/images/logo-dark.png'),
        'favicon_path' => asset('assets/images/favicon.ico'),
    ];
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">General Settings</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Profile & Settings</a></li>
                        <li class="breadcrumb-item active">General Settings</li>
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

    {{-- General Settings Form --}}
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">App Configuration</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" type="checkbox" id="appStatusSwitch" {{ $settings->app_status ? 'checked' : '' }}>
                            <label class="form-check-label" for="appStatusSwitch">App Status: {{ $settings->app_status ? 'Live' : 'Maintenance' }}</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" id="generalSettingsForm" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="appName" class="form-label">App Name</label>
                                    <input type="text" class="form-control @error('app_name') is-invalid @enderror" id="appName" name="app_name" value="{{ old('app_name', $settings->app_name) }}" required>
                                    @error('app_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactEmail" class="form-label">Contact Email</label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contactEmail" name="contact_email" value="{{ old('contact_email', $settings->contact_email) }}" required>
                                    @error('contact_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contactPhone" class="form-label">Contact Phone</label>
                                    <input type="tel" class="form-control @error('contact_phone') is-invalid @enderror" id="contactPhone" name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}" required>
                                    @error('contact_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="appAddress" class="form-label">App Address / Location</label>
                                    <textarea class="form-control @error('app_address') is-invalid @enderror" id="appAddress" name="app_address" rows="3" required>{{ old('app_address', $settings->app_address) }}</textarea>
                                    @error('app_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="appLogo" class="form-label">App Logo</label>
                                    <input type="file" class="form-control @error('app_logo') is-invalid @enderror" id="appLogo" name="app_logo" accept="image/*">
                                    @error('app_logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="logoPreview" src="{{ $settings->logo_path }}" alt="Current Logo" class="rounded" style="max-width: 200px; max-height: 100px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="appFavicon" class="form-label">App Favicon</label>
                                    <input type="file" class="form-control @error('app_favicon') is-invalid @enderror" id="appFavicon" name="app_favicon" accept="image/*">
                                    @error('app_favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="faviconPreview" src="{{ $settings->favicon_path }}" alt="Current Favicon" class="rounded" style="max-width: 32px; max-height: 32px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quick Tips</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-primary rounded-circle fs-2">
                                <i class="ri-information-fill"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">Logo Guidelines</h6>
                            <p class="text-muted mb-0">Use PNG format with transparent background. Recommended size: 512x512 px.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-success rounded-circle fs-2">
                                <i class="ri-check-double-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">Contact Verification</h6>
                            <p class="text-muted mb-0">Ensure email and phone are active for user notifications.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-warning rounded-circle fs-2">
                                <i class="ri-alert-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">Backup Settings</h6>
                            <p class="text-muted mb-0">Changes will be backed up automatically. Review audit logs in Activity section.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection