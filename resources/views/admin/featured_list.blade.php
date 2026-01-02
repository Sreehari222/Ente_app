{{-- resources/views/admin/listings/featured-listings.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Featured Listings</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.all-listings') }}">Listings</a></li>
                        <li class="breadcrumb-item active">Featured</li>
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

    {{-- Search Form --}}
    <div class="row mb-3">
        <div class="col-12">
            <form method="GET" action="{{ route('admin.featured-listings') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" placeholder="Search by title, provider, or type..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('admin.featured-listings') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Featured Listings Cards Grid --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Paid/premium listings highlighted at the top ({{ $listings->total() }} total)</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @forelse($listings as $listing)
                            <div class="col-xl-4 col-md-6">
                                <div class="card listing-card position-relative">
                                    @if($listing->featured)
                                        <div class="premium-icon">
                                            <i class="ri-crown-line"></i>
                                        </div>
                                    @endif
                                    <div class="card-body pt-{{ $listing->featured ? '4' : '3' }}">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <span class="listing-icon {{ $listing->type === 'service' ? 'service-icon' : 'shop-icon' }}">
                                                    <i class="{{ $listing->icon ?? ($listing->type === 'service' ? 'ri-lightbulb-line' : 'ri-shopping-cart-line') }}"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ $listing->title }}</h6>
                                                <p class="text-muted mb-0 small">{{ $listing->type === 'service' ? 'Service' : 'Shop' }} by {{ $listing->provider_name }} {{ $listing->featured ? '(Premium)' : '' }}</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="badge featured-badge">Featured</span>
                                            </div>
                                        </div>
                                        <p class="text-muted small mb-3">{{ Str::limit($listing->description, 100) }}</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.listings.show', $listing->id) }}" class="btn btn-sm btn-primary">View</a>
                                            <a href="{{ route('admin.listings.edit', $listing->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.listings.demote', $listing->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Demote this featured listing?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger">Demote</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="ri-star-line fs-1 text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">No featured listings.</h5>
                                    <p class="text-muted">{{ request('search') ? 'Try adjusting your search.' : 'Promote some listings to featured.' }}</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    {{-- Pagination --}}
                    @if($listings->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $listings->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection