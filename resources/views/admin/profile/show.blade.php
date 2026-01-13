@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')
    @php
        $submissions = $submissions ?? collect();
    @endphp

    <div class="container-fluid">

        <h4 class="mb-4">Admin Profile</h4>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#personal">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#submissions">Submissions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#password">Change Password</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">

                    {{-- PERSONAL DETAILS --}}
                    <div class="tab-pane fade show active" id="personal">
                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Name</label>
                                    <input class="form-control" name="name" value="{{ $user->name }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input class="form-control" name="email" value="{{ $user->email }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Phone</label>
                                    <input class="form-control" name="phone" value="{{ $user->phone_number }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Address</label>
                                    <input class="form-control" name="address" value="{{ $user->address }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>IFSC Code</label>
                                    <input class="form-control" name="ifsc" value="{{ $user->ifsc_code }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Account Number</label>
                                    <input class="form-control" name="account_number" value="{{ $user->account_number }}">
                                </div>
                            </div>

                            <button class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>

                    {{-- SUBMISSIONS --}}
                    <div class="tab-pane fade" id="submissions">

                        <form action="{{ route('admin.submissions.submissions') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label>Title</label>
                                <input class="form-control" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label>Upload File (Image / PDF)</label>
                                <input class="form-control" type="file" name="file" required>
                            </div>

                            <button class="btn btn-success">Submit</button>
                        </form>

                        <hr>

                        <h6>My Submissions</h6>

                        @if ($submissions->count())
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Date</th>
                                        <th>Action</th> {{-- New column --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submissions as $submission)
                                        <tr>
                                            <td>{{ $submission->title }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">
                                                    View
                                                </a>
                                            </td>
                                            <td>{{ $submission->created_at->format('d M Y') }}</td>
                                            <td>

                                                <form action="{{ route('admin.submissions.destroy', $submission->id) }}"
                                                    method="POST" class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info text-center mt-3">
                                No submissions yet. Upload your first document.
                            </div>
                        @endif


                    </div>

                    {{-- PASSWORD --}}
                    <div class="tab-pane fade" id="password">
                        <form action="{{ route('admin.profile.change-password') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
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
