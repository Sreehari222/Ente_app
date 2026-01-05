@extends('layouts.admin')

@section('content')

    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">All Advertisements</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Advertisements</a></li>
                        <li class="breadcrumb-item active">All Ads</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Create New Ad Button --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-end">
                    <a href="{{ route('admin.create-ads') }}" class="btn btn-primary">
                        <i class="ri-add-line align-middle me-1"></i> Create New Ad
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Advertisements --}}
    <div class="row">
        @forelse($ads as $ad)
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card h-100">

                    {{-- Image / Video --}}
                    @if ($ad->media)
                        @php
                            $ext = pathinfo($ad->media, PATHINFO_EXTENSION);
                        @endphp

                        @if (in_array($ext, ['mp4', 'webm', 'ogg']))
                            <video class="w-100" height="200" controls>
                                <source src="{{ asset('storage/' . $ad->media) }}" type="video/{{ $ext }}">
                            </video>
                        @else
                            <img src="{{ asset('storage/' . $ad->media) }}" class="card-img-top"
                                style="height:200px; object-fit:cover;" alt="{{ $ad->title }}">
                        @endif
                    @else
                        <img src="https://via.placeholder.com/400x200?text=No+Media" class="card-img-top" alt="No Media">
                    @endif

                    <div class="card-body">
                        <h6 class="card-title">{{ $ad->title }}</h6>

                        <span class="badge {{ $ad->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($ad->status) }}
                        </span>

                        <div class="text-muted small mt-2">
                            <div>Start: {{ $ad->start_date }}</div>
                            <div>End: {{ $ad->end_date }}</div>
                        </div>

                        @if ($ad->target_url)
                            <a href="{{ $ad->target_url }}" target="_blank" class="d-block mt-2 small">
                                Visit Target URL
                            </a>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('admin.admin.ads.edit', $ad->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="ri-edit-line"></i> Edit
                            </a>

                            <form action="{{ route('admin.admin.ads.destroy', $ad->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this ad?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="ri-advertisement-line fs-1 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">No advertisements found</h5>
                    <p class="text-muted">Create your first ad to get started.</p>
                </div>
            </div>
        @endforelse
    </div>

@endsection
