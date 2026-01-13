@extends('layouts.admin')

@section('title', 'View Vendor')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            <h4>Vendor Details</h4>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                <i class="ri-arrow-left-line"></i> Back
            </a>
        </div>

        {{-- ================= SHOP DETAILS ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-store-2-line me-1"></i> Shop / Service Details</h5>
                <div class="row g-3">
                    <div class="col-md-6"><strong>Shop Name:</strong><br>{{ $vendor->shop_name }}</div>
                    <div class="col-md-6"><strong>Owner Name:</strong><br>{{ $vendor->owner_name ?? '-' }}</div>
                    <div class="col-md-6"><strong>Mobile:</strong><br>{{ $vendor->mobile }}</div>
                    <div class="col-md-6"><strong>WhatsApp:</strong><br>{{ $vendor->whatsapp ?? '-' }}</div>
                    <div class="col-md-6"><strong>Email:</strong><br>{{ $vendor->email ?? '-' }}</div>
                    <div class="col-md-6"><strong>DIGIPIN:</strong><br>{{ $vendor->digipin ?? '-' }}</div>
                    <div class="col-12"><strong>Address:</strong><br>{{ $vendor->address ?? '-' }}</div>
                    <div class="col-md-6">
                        <strong>Google Map:</strong><br>
                        @if ($vendor->google_map)
                            <a href="{{ $vendor->google_map }}" target="_blank">Open Map</a>
                        @else
                            -
                        @endif
                    </div>
                    <div class="col-md-6"><strong>Service Area:</strong><br>{{ $vendor->service_area ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- ================= CATEGORY & PLAN ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-list-check-2 me-1"></i> Category & Plan</h5>
                <div class="row g-3">
                    <div class="col-md-4"><strong>Main Category:</strong><br>{{ $vendor->mainCategory->name ?? '-' }}</div>
                    <div class="col-md-4"><strong>Category:</strong><br>{{ $vendor->category->name ?? '-' }}</div>
                    <div class="col-md-4"><strong>Plan:</strong><br>{{ $vendor->plan->title ?? '-' }}
                        (₹{{ $vendor->plan->amount ?? 0 }})</div>
                </div>
            </div>
        </div>

        {{-- ================= WORKING HOURS ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-time-line me-1"></i> Working Hours</h5>
                <div class="row">
                    <div class="col-md-6"><strong>Opening:</strong> {{ $vendor->opening_time ?? '-' }}</div>
                    <div class="col-md-6"><strong>Closing:</strong> {{ $vendor->closing_time ?? '-' }}</div>
                </div>
            </div>
        </div>

        {{-- ================= SOCIAL MEDIA ================= --}}
        @if ($vendor->social_links)
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Social Links</h5>
                </div>
                <div class="card-body">
                    @foreach ($vendor->social_links as $social)
                        @if (is_array($social))
                            <p>
                                <strong>{{ $social['platform'] ?? 'Link' }}:</strong>
                                <a href="{{ $social['url'] ?? '#' }}" target="_blank">{{ $social['url'] ?? '-' }}</a>
                            </p>
                        @else
                            <p><a href="{{ $social }}" target="_blank">{{ $social }}</a></p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif




        {{-- ================= IMAGES ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-image-line me-1"></i> Images</h5>
                <div class="mb-3">
                    <strong>Profile Photo</strong><br>
                    @if ($vendor->photo)
                        <img src="{{ asset('storage/' . $vendor->photo) }}" class="img-thumbnail" width="120">
                    @else
                        -
                    @endif
                </div>
                <div>
                    <strong>Gallery</strong><br>
                    <div class="d-flex gap-2 flex-wrap">
                        @forelse($vendor->gallery ?? [] as $img)
                            <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail" width="120">
                        @empty
                            <span class="text-muted">No images</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= PAYMENT ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-bank-card-line me-1"></i> Payment</h5>
                <p><strong>Mode:</strong> {{ ucfirst($vendor->payment_mode) }}</p>
                <p><strong>Transaction ID:</strong> {{ $vendor->transaction_id ?? '-' }}</p>
                <p><strong>Reference:</strong> {{ $vendor->reference_number ?? '-' }}</p>
            </div>
        </div>
        {{-- ================= DENOMINATIONS / TOTAL ================= --}}
        @if ($vendor->denominations)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Received Amounts</h5>
                </div>
                <div class="card-body row">
                    @php $totalAmount = 0; @endphp
                    @foreach ($vendor->denominations as $denom => $count)
                        @php $totalAmount += $denom * $count; @endphp
                        <div class="col-md-2 mb-2">
                            <strong>₹{{ $denom }}:</strong> {{ $count }}
                        </div>
                    @endforeach
                    <div class="col-12 mt-3"><strong>Total Amount Received: ₹{{ $totalAmount }}</strong></div>
                </div>
            </div>
        @endif

        {{-- ================= COMMENTS ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-chat-quote-line me-1"></i> Comments</h5>
                <p><strong>Special Recommendation:</strong><br>{{ $vendor->special_recommendation ?? '-' }}</p>
                <p><strong>Internal Notes:</strong><br>{{ $vendor->internal_comments ?? '-' }}</p>
            </div>
        </div>

        {{-- ================= META ================= --}}
        <div class="card mb-4">
            <div class="card-body row">
                <div class="col-md-4"><strong>Created At:</strong> {{ $vendor->created_at }}</div>
                <div class="col-md-4"><strong>Approved At:</strong> {{ $vendor->approved_at ?? '-' }}</div>
                <div class="col-md-4"><strong>Created By:</strong> {{ $vendor->creator->name ?? 'N/A' }}</div>
                <div class="col-md-4"><strong>Status:</strong> {{ ucfirst($vendor->status) }}</div>
            </div>
        </div>

    </div>
@endsection
