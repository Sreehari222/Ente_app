{{-- resources/views/admin/listings/all-listings.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">All Listings</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Listings</a></li>
                        <li class="breadcrumb-item active">All Active Listings</li>
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
            <form method="GET" action="{{ route('admin.all-listings') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" placeholder="Search by title, provider, or type..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('admin.all-listings') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- All Listings Cards Grid --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Active Services and Shop Listings ({{ $listings->total() }} total)</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @forelse($listings as $listing)
                            <div class="col-xl-4 col-md-6">
                                <div class="card listing-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <span class="listing-icon {{ $listing->type === 'service' ? 'service-icon' : 'shop-icon' }}">
                                                    <i class="{{ $listing->icon ?? ($listing->type === 'service' ? 'ri-plug-2-line' : 'ri-store-line') }}"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ $listing->title }}</h6>
                                                <p class="text-muted mb-0 small">Listing by {{ $listing->provider_name }}</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="badge bg-success-subtle text-success">Active</span>
                                            </div>
                                        </div>
                                        <p class="text-muted small mb-3">{{ Str::limit($listing->description, 100) }}</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.listings.show', $listing->id) }}" class="btn btn-sm btn-primary">View</a>
                                            <a href="{{ route('admin.listings.edit', $listing->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.listings.deactivate', $listing->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Deactivate this listing?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger">Deactivate</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="ri-list-unordered fs-1 text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">No listings found.</h5>
                                    <p class="text-muted">{{ request('search') ? 'Try adjusting your search.' : 'No active listings yet.' }}</p>
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