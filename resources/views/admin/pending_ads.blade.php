{{-- resources/views/admin/advertisements/pending-ads.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Pending Ads
    $pendingAds = collect([
        (object) [
            'id' => 1,
            'title' => 'Summer Sale Banner',
            'image' => asset('assets/images/ads-sample-1.jpg'),
            'submitted_by' => 'ABC Marketing Ltd.',
            'type' => 'Banner',
            'submitted_date' => '2025-11-28',
        ],
        (object) [
            'id' => 2,
            'title' => 'New Product Launch Video',
            'image' => asset('assets/images/ads-sample-2.jpg'),
            'submitted_by' => 'XYZ Corp.',
            'type' => 'Video',
            'submitted_date' => '2025-11-29',
        ],
        (object) [
            'id' => 3,
            'title' => 'Discount Offer Native Ad',
            'image' => asset('assets/images/ads-sample-3.jpg'),
            'submitted_by' => 'Local Business Inc.',
            'type' => 'Native',
            'submitted_date' => '2025-12-01',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Pending Ads</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Advertisements</a></li>
                        <li class="breadcrumb-item active">Pending Ads</li>
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

    {{-- Pending Ads Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Pending Advertisements for Approval</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-soft-secondary btn-sm material-shadow-none">
                            <i class="ri-arrow-left-line align-middle"></i> Back to All Ads
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAllPending" value="option">
                                            <label class="form-check-label" for="checkAllPending"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Ad Title</th>
                                    <th class="border-0">Submitted By (Business)</th>
                                    <th class="border-0">Type</th>
                                    <th class="border-0">Submitted Date</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingAds as $ad)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="pendingAd{{ $ad->id }}" value="option{{ $ad->id }}">
                                                <label class="form-check-label" for="pendingAd{{ $ad->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $ad->image }}" alt="" class="avatar-xxs rounded">
                                                </div>
                                                <div class="flex-grow-1 ms-2 name">
                                                    {{ $ad->title }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $ad->submitted_by }}</td>
                                        <td>{{ $ad->type }}</td>
                                        <td>{{ $ad->submitted_date }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-soft-primary material-shadow-none">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Approve this ad?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success material-shadow-none">
                                                    <i class="ri-check-line"></i> Approve
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger material-shadow-none" data-bs-toggle="modal" data-bs-target="#rejectAdModal" data-ad-id="{{ $ad->id }}">
                                                <i class="ri-close-line"></i> Reject
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="ri-time-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No pending ads found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        <ul class="pagination pagination-separated pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a href="#" class="page-link">←</a>
                            </li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item active"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">→</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- View Ad Modal (Static Example) --}}
    <div class="modal fade" id="viewAdModal" tabindex="-1" aria-labelledby="viewAdModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAdModalLabel">View Advertisement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('assets/images/ads-sample-1.jpg') }}" alt="Ad Preview" class="img-fluid mb-3">
                    <p><strong>Title:</strong> Summer Sale Banner</p>
                    <p><strong>Description:</strong> Check out our amazing summer deals!</p>
                    <p><strong>Target URL:</strong> https://example.com/summer-sale</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Reject Ad Modal --}}
    <div class="modal fade" id="rejectAdModal" tabindex="-1" aria-labelledby="rejectAdModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectAdModalLabel">Reject Advertisement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf @method('PATCH')
                    <div class="modal-body">
                        <p>Are you sure you want to reject this ad? Provide a reason:</p>
                        <textarea class="form-control" name="reason" rows="3" placeholder="Enter rejection reason..." required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection