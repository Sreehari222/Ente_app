{{-- resources/views/admin/listings/pending-approvals.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Pending Approvals</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.all-listings') }}">Listings</a></li>
                        <li class="breadcrumb-item active">Pending Approvals</li>
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
            <form method="GET" action="{{ route('admin.pending-approvals') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" placeholder="Search by title, provider, or type..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ route('admin.pending-approvals') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Pending Approvals Cards Grid --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">New or updated listings waiting for admin approval ({{ $listings->total() }} total)</h5>
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
                                                    <i class="{{ $listing->icon ?? ($listing->type === 'service' ? 'ri-tools-line' : 'ri-building-line') }}"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ $listing->title }}</h6>
                                                <p class="text-muted mb-0 small">{{ $listing->type === 'service' ? 'Service' : 'Shop' }} by {{ $listing->provider_name }} {{ $listing->updated_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <span class="badge pending-badge">Pending</span>
                                            </div>
                                        </div>
                                        <p class="text-muted small mb-3">{{ Str::limit($listing->description, 100) }}</p>
                                        <div class="d-flex gap-1 approval-actions">
                                            <a href="{{ route('admin.listings.show', $listing->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                            <form action="{{ route('admin.listings.approve', $listing->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Approve this listing?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.listings.reject', $listing->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Reject this listing?')">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                            </form>
                                            <a href="{{ route('admin.listings.edit', $listing->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="ri-time-line fs-1 text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">No pending approvals.</h5>
                                    <p class="text-muted">{{ request('search') ? 'Try adjusting your search.' : 'All listings are approved.' }}</p>
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