@extends('layouts.area_operator')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">

        <!-- LEFT PROFILE SUMMARY -->
        <div class="col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body text-center">
                    <img id="profilePreview" src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://via.placeholder.com/100' }}"
                        class="rounded-circle mb-3" width="90" height="90" style="object-fit:cover">
                    <h6 class="mb-0">{{ $user->name }}</h6>
                    <small class="text-muted">{{ $user->email }}</small>
                </div>
                <div class="card-body border-top text-start small">
                    <p class="mb-1"><strong>Address:</strong><br>{{ $user->address ?? '-' }}</p>
                    <p class="mb-1"><strong>Account Number:</strong> {{ $user->account_number ?? '-' }}</p>
                    <p class="mb-0"><strong>IFSC:</strong> {{ $user->ifsc_code ?? '-' }}</p>
                </div>
            </div>

            <!-- Submissions -->
            <div class="row g-2">
                @forelse($submissions as $submission)
                    <div class="col-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('storage/' . $submission->file_path) }}" class="card-img-top"
                                style="height:110px;object-fit:cover">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted d-block">
                                    {{ $submission->created_at->format('d M Y') }}
                                </small>
                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                                    class="btn btn-sm btn-primary mt-1">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">No submissions</p>
                @endforelse
            </div>
        </div>

        <!-- RIGHT EDIT PROFILE -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Edit Profile</h6>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('area.profile.update', ['user' => $user->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                        <!-- PERSONAL DETAILS -->
                        <h6 class="text-muted mb-3">Personal Details</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                            </div>
                        </div>

                        <!-- BANK INFO -->
                        <h6 class="text-muted mt-4 mb-3">Bank Info</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="account_number" value="{{ $user->account_number }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">IFSC</label>
                                <input type="text" name="ifsc_code" value="{{ $user->ifsc_code }}" class="form-control">
                            </div>
                        </div>

                        <!-- PHOTOS -->
                        <h6 class="text-muted mt-4 mb-3">Photos</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Profile Photo</label>
                                <input type="file" name="profile_photo" class="form-control" accept="image/*" onchange="previewImage(event, 'profilePreview')">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cover Photo</label>
                                <input type="file" name="cover_photo" class="form-control" accept="image/*" onchange="previewImage(event, 'coverPreview')">
                                <img id="coverPreview" src="{{ $user->cover_photo ? asset('storage/' . $user->cover_photo) : '' }}" class="img-fluid mt-2" style="max-height:100px; object-fit:cover;">
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                Update Profile
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function previewImage(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);
    if(input.files && input.files[0]){
        const reader = new FileReader();
        reader.onload = function(e){
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
