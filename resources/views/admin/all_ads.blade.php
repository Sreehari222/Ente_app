{{-- resources/views/admin/advertisements/all-ads.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Advertisements
    $ads = collect([
        (object) [
            'id' => 1,
            'title' => 'Summer Sale Banner',
            'image' => 'https://i.pinimg.com/736x/a5/70/b2/a570b24be17b91439bd7092852c9c4d4.jpg',
            'type' => 'Banner',
            'type_badge' => 'bg-primary-subtle text-primary',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'start_date' => '2025-06-01',
            'end_date' => '2025-08-31',
            'impressions' => 45230,
            'clicks' => 1245,
            'description' => 'Banner ad for seasonal promotion',
        ],
        (object) [
            'id' => 2,
            'title' => 'Tech Gadgets Promo',
            'image' => 'https://i.pinimg.com/1200x/f0/f9/e4/f0f9e45724771f16745ad3f6f640d3ce.jpg',
            'type' => 'Interstitial',
            'type_badge' => 'bg-info-subtle text-info',
            'status' => 'Paused',
            'status_badge' => 'bg-warning-subtle text-warning',
            'start_date' => '2025-11-15',
            'end_date' => '2025-12-31',
            'impressions' => 12450,
            'clicks' => 567,
            'description' => 'Interstitial ad for electronics',
        ],
        (object) [
            'id' => 3,
            'title' => 'Local Services Video',
            'image' => 'https://via.placeholder.com/300x150/28a745/ffffff?text=Local+Services+Video',
            'type' => 'Video',
            'type_badge' => 'bg-success-subtle text-success',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'start_date' => '2025-10-01',
            'end_date' => '2025-12-04',
            'impressions' => 78901,
            'clicks' => 2340,
            'description' => 'Video ad for service providers',
        ],
        (object) [
            'id' => 4,
            'title' => 'Holiday Deals Native',
            'image' => 'https://i.pinimg.com/1200x/a3/6a/10/a36a1009493fc69a6d2d41ebf58f05ac.jpg',
            'type' => 'Native',
            'type_badge' => 'bg-warning-subtle text-warning',
            'status' => 'Expired',
            'status_badge' => 'bg-danger-subtle text-danger',
            'start_date' => '2025-11-01',
            'end_date' => '2025-11-30',
            'impressions' => 23678,
            'clicks' => 890,
            'description' => 'Native ad for shop owners',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">All Advertisements</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Advertisements</a></li>
                        <li class="breadcrumb-item active">All Ads</li>
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

    {{-- Create New Ad Button --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-end">
                    <a href="" class="btn btn-primary">
                        <i class="ri-add-line align-middle me-1"></i> Create New Ad
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- All Advertisements Cards --}}
    <div class="row">
        @forelse($ads as $ad)
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card ad-card">
                    <img src="{{ $ad->image }}" class="card-img-top" alt="{{ $ad->title }}">
                    <div class="card-body">
                        <h6 class="card-title">{{ $ad->title }}</h6>
                        <p class="card-text text-muted small">{{ $ad->description }}</p>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge {{ $ad->type_badge }}">{{ $ad->type }}</span>
                            <span class="badge {{ $ad->status_badge }}">{{ $ad->status }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>Start: {{ $ad->start_date }}</span>
                            <span>End: {{ $ad->end_date }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-success">Impressions: {{ number_format($ad->impressions) }}</span>
                            <span class="text-info">Clicks: {{ number_format($ad->clicks) }}</span>
                        </div>
                        <div class="d-flex gap-1 mt-2">
                            <a href="" class="btn btn-sm btn-info flex-fill">View</a>
                            <a href="" class="btn btn-sm btn-warning flex-fill">Edit</a>
                            <form action="" method="POST" style="display: inline; flex: 1;" onsubmit="return confirm('Delete this ad?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="ri-advertisement-line fs-1 text-muted mb-3 d-block"></i>
                    <h5 class="text-muted">No advertisements found.</h5>
                    <p class="text-muted">Create your first ad to get started.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Static View Ad Modal --}}
    <div class="modal fade" id="viewAdModal" tabindex="-1" aria-labelledby="viewAdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAdModalLabel">View Advertisement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Title:</strong> Sample Ad Title</p>
                    <p><strong>Type:</strong> <span class="badge bg-primary-subtle text-primary">Banner</span></p>
                    <p><strong>Status:</strong> <span class="badge bg-success-subtle text-success">Active</span></p>
                    <p><strong>Start Date:</strong> 2025-06-01</p>
                    <p><strong>End Date:</strong> 2025-08-31</p>
                    <p><strong>Impressions:</strong> 45,230</p>
                    <p><strong>Clicks:</strong> 1,245</p>
                    <p><strong>Image/URL:</strong> <a href="#" target="_blank">View Media</a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Ad Modal --}}
    <div class="modal fade" id="editAdModal" tabindex="-1" aria-labelledby="editAdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdModalLabel">Edit Advertisement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="editAdTitle" class="form-label">Ad Title</label>
                            <input type="text" class="form-control" id="editAdTitle" value="Sample Ad Title">
                        </div>
                        <div class="mb-3">
                            <label for="editAdType" class="form-label">Ad Type</label>
                            <select class="form-select" id="editAdType">
                                <option value="banner">Banner</option>
                                <option value="interstitial">Interstitial</option>
                                <option value="video">Video</option>
                                <option value="native">Native</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editAdImage" class="form-label">Ad Image/URL</label>
                            <input type="url" class="form-control" id="editAdImage" value="https://example.com/ad-image.jpg">
                        </div>
                        <div class="mb-3">
                            <label for="editStartDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="editStartDate" value="2025-06-01">
                        </div>
                        <div class="mb-3">
                            <label for="editEndDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="editEndDate" value="2025-08-31">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-primary">Save Changes</a>
                </div>
            </div>
        </div>
    </div>
@endsection