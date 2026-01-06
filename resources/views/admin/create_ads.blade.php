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
                        <a href="{{ route('admin.all-ads') }}" class="btn btn-soft-secondary btn-sm material-shadow-none">
                            <i class="ri-arrow-left-line align-middle"></i> Back to All Ads
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            {{-- Ad Title --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adTitle" class="form-label">Ad Title</label>
                                    <input type="text"
                                           class="form-control @error('adTitle') is-invalid @enderror"
                                           id="adTitle"
                                           name="adTitle"
                                           placeholder="Enter ad title"
                                           value="{{ old('adTitle') }}"
                                           required>
                                    @error('adTitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adStatus" class="form-label">Status</label>
                                    <select class="form-select @error('adStatus') is-invalid @enderror"
                                            id="adStatus"
                                            name="adStatus"
                                            required>
                                        <option value="active" {{ old('adStatus') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('adStatus') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('adStatus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Start & End Date --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date"
                                           class="form-control @error('startDate') is-invalid @enderror"
                                           id="startDate"
                                           name="startDate"
                                           value="{{ old('startDate') }}"
                                           required>
                                    @error('startDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date"
                                           class="form-control @error('endDate') is-invalid @enderror"
                                           id="endDate"
                                           name="endDate"
                                           value="{{ old('endDate') }}"
                                           required>
                                    @error('endDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Media Upload --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adImage" class="form-label">Ad Image / Video</label>
                                    <input type="file"
                                           class="form-control @error('adImage') is-invalid @enderror"
                                           id="adImage"
                                           name="adImage"
                                           accept="image/*,video/*">
                                    <small class="text-muted">Max size 10MB</small>
                                    @error('adImage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Target URL --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="targetUrl" class="form-label">Target URL</label>
                                    <input type="url"
                                           class="form-control @error('targetUrl') is-invalid @enderror"
                                           id="targetUrl"
                                           name="targetUrl"
                                           placeholder="https://example.com"
                                           value="{{ old('targetUrl') }}">
                                    @error('targetUrl')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Actions --}}
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
