@extends('layouts.admin')

@php
    $user = auth()->user() ?? (object) [
        'id' => 1,
        'name' => 'Anna Adame',
        'email' => 'anna@admin.com',
        'phone' => '+91 98765 43210',
        'dob' => '1985-03-15',
        'address' => '123 Main Street, Panchayath Locality, Hyderabad, Telangana 500001',
        'avatar' => asset('assets/images/users/avatar-1.jpg'),
        'role' => 'Founder & CEO',
        'joined_at' => 'January 15, 2023',
        'two_factor_enabled' => true,
    ];

    // Dummy recent activity
    $recentActivity = collect([
        (object) ['action' => 'Updated User Verification', 'time' => '2 hours ago'],
        (object) ['action' => 'Reviewed Listing Approvals', 'time' => 'Yesterday'],
        (object) ['action' => 'Configured App Settings', 'time' => '2 days ago'],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Profile</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Profile & Settings</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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

    {{-- Profile Overview --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-sm-2">
                            <div class="text-sm-center">
                                <img id="profileAvatar" src="{{ $user->avatar }}" alt="profile-img" class="avatar-lg rounded-circle mx-auto d-block" />
                                <div class="mt-3">
                                    <label for="profileImg" class="btn btn-sm btn-soft-primary">
                                        <i class="ri-camera-line align-middle me-1"></i> Change Photo
                                    </label>
                                    <input type="file" class="d-none" id="profileImg" name="avatar" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="text-sm-end mt-3 mt-sm-0">
                                <h4 id="profileName" class="mb-1 fs-3 fw-semibold">{{ $user->name }}</h4>
                                <p class="text-muted mb-1 fs-14">{{ $user->role }}</p>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <i class="ri-mail-line fs-18 align-middle text-muted me-1"></i>
                                        <span class="text-muted">{{ $user->email }}</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-phone-line fs-18 align-middle text-muted me-1"></i>
                                        <span class="text-muted">{{ $user->phone }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Profile Tabs --}}
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-overview-tab" data-bs-toggle="tab" href="#profile-overview" role="tab" aria-controls="profile-overview" aria-selected="true">
                        <i class="ri-user-line me-1 align-bottom fs-18"></i> Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-personal-tab" data-bs-toggle="tab" href="#profile-personal" role="tab" aria-controls="profile-personal" aria-selected="false">
                        <i class="ri-account-circle-line me-1 align-bottom fs-18"></i> Personal Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-security-tab" data-bs-toggle="tab" href="#profile-security" role="tab" aria-controls="profile-security" aria-selected="false">
                        <i class="ri-lock-line me-1 align-bottom fs-18"></i> Security
                    </a>
                </li>
            </ul>
            <div class="card">
                <div class="card-body p-4">
                    <div class="tab-content" id="profile-tabContent">
                        {{-- Overview Tab --}}
                        <div class="tab-pane fade show active" id="profile-overview" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="text-center">
                                        <i class="ri-award-line text-primary fs-1 mb-3 d-block"></i>
                                        <h5 class="fw-semibold">Admin Role</h5>
                                        <p class="text-muted">Full access to all features and management tools.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-center">
                                        <i class="ri-team-line text-success fs-1 mb-3 d-block"></i>
                                        <h5 class="fw-semibold">Team Member</h5>
                                        <p class="text-muted">Part of the core administrative team.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-center">
                                        <i class="ri-calendar-check-line text-info fs-1 mb-3 d-block"></i>
                                        <h5 class="fw-semibold">Joined</h5>
                                        <p class="text-muted">{{ $user->joined_at }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="fw-semibold mb-3">Recent Activity</h5>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-centered align-middle mb-0">
                                            <tbody>
                                                @forelse($recentActivity as $activity)
                                                    <tr>
                                                        <td class="fw-medium">{{ $activity->action }}</td>
                                                        <td>{{ $activity->time }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="2" class="text-center text-muted">No recent activity.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Personal Info Tab --}}
                        <div class="tab-pane fade" id="profile-personal" role="tabpanel">
                            <form action="" method="POST" id="personalForm" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" name="first_name" value="{{ old('first_name', explode(' ', $user->name)[0]) }}" required>
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" name="last_name" value="{{ old('last_name', explode(' ', $user->name)[1] ?? '') }}" required>
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', $user->dob) }}">
                                            @error('dob')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ old('address', $user->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update Personal Info</button>
                                </div>
                            </form>
                        </div>

                        {{-- Security Tab --}}
                        <div class="tab-pane fade" id="profile-security" role="tabpanel">
                            <form action="" method="POST" id="securityForm">
                                @csrf @method('PUT')
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label">Current Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword" name="current_password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">New Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" name="password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Two-Factor Authentication</label>
                                            <div class="form-check form-switch form-switch-md">
                                                <input class="form-check-input" type="checkbox" id="twoFactor" name="two_factor_enabled" {{ old('two_factor_enabled', $user->two_factor_enabled) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="twoFactor">Enable 2FA</label>
                                            </div>
                                            @error('two_factor_enabled')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Session Management</label>
                                            <div class="text-muted small">Active Sessions: 2<br>Device: iPhone 14 • Last active: 1 hour ago</div>
                                            <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="logoutAll()">Sign Out All</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update Security</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Handle avatar change
    document.getElementById('profileImg').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileAvatar').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle personal form submission
    document.getElementById('personalForm').addEventListener('submit', function(e) {
        // Client-side validation if needed
        e.preventDefault(); // Remove if using full form submit
        // Submit form via JS or let it go
    });

    // Handle security form submission
    document.getElementById('securityForm').addEventListener('submit', function(e) {
        const newPass = document.getElementById('newPassword').value;
        const confirmPass = document.getElementById('confirmPassword').value;
        if (newPass !== confirmPass) {
            e.preventDefault();
            alert('Passwords do not match!');
            return;
        }
        // Submit form
    });

    function logoutAll() {
        if (confirm('Sign out from all devices?')) {
            // POST to logout all route
            alert('All sessions signed out!');
        }
    }
</script>
@endpush