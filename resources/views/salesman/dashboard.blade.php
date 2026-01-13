@extends('layouts.sales')

@section('title', 'Sales Dashboard')

@section('styles')
    <link href="{{ asset('css/sales.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('salesman.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">sales Overview</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row stats-row">
    {{-- Total Vendors Added --}}
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card card-animate stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-primary-subtle text-primary rounded-2 fs-3">
                            <i class="ri-user-add-line"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-3">
                        <p class="stat-label">Vendors Added</p>
                        <h4 class="stat-value counter-value" data-target="{{ $totalVendors ?? 0 }}">{{ $totalVendors ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Active Vendors --}}
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card card-animate stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-success-subtle text-success rounded-2 fs-3">
                            <i class="ri-user-check-line"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-3">
                        <p class="stat-label">Active Vendors</p>
                        <h4 class="stat-value counter-value" data-target="{{ $activeVendors ?? 0 }}">{{ $activeVendors ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Listings Waiting for Approval --}}
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card card-animate stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-warning-subtle text-warning rounded-2 fs-3">
                            <i class="ri-file-list-3-line"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-3">
                        <p class="stat-label">Pending Listings</p>
                        <h4 class="stat-value counter-value" data-target="{{ $pendingListings ?? 0 }}">{{ $pendingListings ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Active Offers --}}
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card card-animate stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-info-subtle text-info rounded-2 fs-3">
                            <i class="ri-coupon-3-line"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-3">
                        <p class="stat-label">Active Offers</p>
                        <h4 class="stat-value counter-value" data-target="{{ $activeOffers ?? 0 }}">{{ $activeOffers ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Running Advertisements --}}
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card card-animate stat-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-danger-subtle text-danger rounded-2 fs-3">
                            <i class="ri-megaphone-line"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-3">
                        <p class="stat-label">Running Ads</p>
                        <h4 class="stat-value counter-value" data-target="{{ $runningAds ?? 0 }}">{{ $runningAds ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card info-card">
            <div class="card-body">
                <h4 class="card-title mb-4">Progress Tracking</h4>
                <p class="text-muted mb-4">This dashboard helps staff track vendor onboarding, listing approvals, promotional activities, and advertisement campaigns to ensure smooth operations and timely interventions.</p>
                
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        {{-- Recent Vendors Table --}}
                        <h5 class="section-title mb-3">Recent Vendors</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Vendor Name</th>
                                        <th>Status</th>
                                        <th>Added On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentVendors ?? [] as $vendor)
                                        <tr>
                                            <td>{{ $vendor->name }}</td>
                                            <td>
                                                <span class="badge {{ $vendor->is_active ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $vendor->is_active ? 'Active' : 'Pending' }}
                                                </span>
                                            </td>
                                            <td>{{ $vendor->created_at->format('M d, Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center">No recent vendors.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        {{-- Active Offers List --}}
                        <h5 class="section-title mb-3">Active Offers</h5>
                        <div class="list-group list-group-flush">
                            @forelse($activeOffersList ?? [] as $offer)
                                <div class="list-group-item px-0 border-bottom">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $offer->title }}</h6>
                                        <small class="text-muted">{{ $offer->ends_at->format('M d') }}</small>
                                    </div>
                                    <p class="mb-1 text-muted">{{ Str::limit($offer->description, 50) }}</p>
                                </div>
                            @empty
                                <p class="text-muted">No active offers.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
@endsection