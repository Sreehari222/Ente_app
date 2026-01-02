{{-- resources/views/admin/advertisements/create.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Create New Ad</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Advertisements</a></li>
                        <li class="breadcrumb-item active">Create New Ad</li>
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
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Create New Ad Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add New Advertisement</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-soft-secondary btn-sm material-shadow-none">
                            <i class="ri-arrow-left-line align-middle"></i> Back to All Ads
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adTitle" class="form-label">Ad Title</label>
                                    <input type="text" class="form-control @error('adTitle') is-invalid @enderror" id="adTitle" name="adTitle" placeholder="Enter ad title" value="{{ old('adTitle') }}" required>
                                    @error('adTitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adType" class="form-label">Ad Type</label>
                                    <select class="form-select @error('adType') is-invalid @enderror" id="adType" name="adType" required>
                                        <option value="">Select Type</option>
                                        <option value="banner" {{ old('adType') == 'banner' ? 'selected' : '' }}>Banner</option>
                                        <option value="interstitial" {{ old('adType') == 'interstitial' ? 'selected' : '' }}>Interstitial</option>
                                        <option value="video" {{ old('adType') == 'video' ? 'selected' : '' }}>Video</option>
                                        <option value="native" {{ old('adType') == 'native' ? 'selected' : '' }}>Native</option>
                                    </select>
                                    @error('adType')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate" value="{{ old('startDate') }}" required>
                                    @error('startDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate" value="{{ old('endDate') }}" required>
                                    @error('endDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="adDescription" class="form-label">Description</label>
                            <textarea class="form-control @error('adDescription') is-invalid @enderror" id="adDescription" name="adDescription" rows="3" placeholder="Enter ad description">{{ old('adDescription') }}</textarea>
                            @error('adDescription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adImage" class="form-label">Ad Image/Video Upload</label>
                                    <input type="file" class="form-control @error('adImage') is-invalid @enderror" id="adImage" name="adImage" accept="image/*,video/*">
                                    <small class="text-muted">Upload image or video file (Max 10MB)</small>
                                    @error('adImage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="targetUrl" class="form-label">Target URL (Click Destination)</label>
                                    <input type="url" class="form-control @error('targetUrl') is-invalid @enderror" id="targetUrl" name="targetUrl" placeholder="https://example.com" value="{{ old('targetUrl') }}">
                                    @error('targetUrl')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="adStatus" class="form-label">Initial Status</label>
                            <select class="form-select @error('adStatus') is-invalid @enderror" id="adStatus" name="adStatus">
                                <option value="active" {{ old('adStatus') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="paused" {{ old('adStatus') == 'paused' ? 'selected' : '' }}>Paused</option>
                                <option value="draft" {{ old('adStatus') == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('adStatus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Ad</button>
                            <a href="" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection