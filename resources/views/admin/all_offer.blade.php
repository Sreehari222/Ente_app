@extends('layouts.admin')

@section('content')

{{-- Page Header --}}
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">All Offers</h4>
            <a href="{{ route('admin.create-offer') }}" class="btn btn-primary btn-sm">
                <i class="ri-add-line"></i> Create Offer
            </a>
        </div>
    </div>
</div>

{{-- Flash Message --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mt-2">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row mt-3">
    @forelse($offers as $offer)
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm offer-card">

                {{-- Image --}}
                <div class="position-relative">
                    @if($offer->image)
                        <img src="{{ asset('storage/' . $offer->image) }}"
                             class="card-img-top"
                             style="height:180px; object-fit:cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light"
                             style="height:180px;">
                            <i class="ri-image-line fs-1 text-muted"></i>
                        </div>
                    @endif

                    {{-- Status Badge --}}
                    <span class="badge position-absolute top-0 end-0 m-2 
                        {{ $offer->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($offer->status) }}
                    </span>
                </div>

                <div class="card-body d-flex flex-column">

                    {{-- Title --}}
                    <h6 class="fw-semibold mb-1">
                        {{ $offer->title }}
                    </h6>

                    {{-- Discount --}}
                    <div class="mb-2">
                        @if($offer->discount_type === 'percentage')
                            <span class="badge bg-info">
                                {{ $offer->discount_value }}% OFF
                            </span>
                        @else
                            <span class="badge bg-warning text-dark">
                                ₹ {{ $offer->discount_value }} OFF
                            </span>
                        @endif
                    </div>

                    {{-- Categories --}}
                    <div class="mb-2">
                        @forelse($offer->categories as $category)
                            <span class="badge bg-light text-dark border mb-1">
                                {{ $category->name }}
                            </span>
                        @empty
                            <span class="text-muted small">No category</span>
                        @endforelse
                    </div>

                    {{-- Dates --}}
                    <p class="text-muted small mb-2">
                        {{ \Carbon\Carbon::parse($offer->start_date)->format('d M Y') }}
                        →
                        {{ \Carbon\Carbon::parse($offer->end_date)->format('d M Y') }}
                    </p>

                    {{-- Actions --}}
                    <div class="mt-auto d-flex justify-content-between">
                        <form action="{{ route('admin.offers.destroy', $offer->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this offer?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <i class="ri-coupon-line fs-1 text-muted"></i>
            <p class="text-muted mt-2">No offers available</p>
        </div>
    @endforelse
</div>

@endsection
