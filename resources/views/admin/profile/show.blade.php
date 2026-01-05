@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">Admin Profile</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab">Personal Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab">Change Password</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="profileTabsContent">

                <!-- Personal Details Tab -->
                <div class="tab-pane fade show active" id="personal" role="tabpanel">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <button class="btn btn-primary">Update Profile</button>
                    </form>
                </div>

                <!-- Change Password Tab -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <form action="{{ route('admin.profile.change-password') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                            @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button class="btn btn-success">Change Password</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
