@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
            ← Back
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            {{-- Header --}}
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">
                    <img src="{{ $vendor->photo ? asset('storage/' . $vendor->photo) : asset('assets/images/users/avatar-1.jpg') }}"
                        class="rounded-circle me-3" width="80" height="80">

                    <div>
                        <h4 class="mb-1">{{ $vendor->shop_name }}</h4>
                        <span
                            class="badge
                        {{ $vendor->status === 'approved' ? 'bg-success' : ($vendor->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                            {{ ucfirst($vendor->status) }}
                        </span>
                    </div>
                </div>
            </div>



            {{-- BASIC INFO --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Basic Information</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-4"><strong>Owner Name:</strong> {{ $vendor->owner_name ?? '—' }}</div>
                    <div class="col-md-4"><strong>Mobile:</strong> {{ $vendor->mobile }}</div>
                    <div class="col-md-4"><strong>WhatsApp:</strong> {{ $vendor->whatsapp ?? '—' }}</div>
                    <div class="col-md-4 mt-2"><strong>Email:</strong> {{ $vendor->email ?? '—' }}</div>
                    <div class="col-md-4 mt-2"><strong>DigiPin:</strong> {{ $vendor->digipin ?? '—' }}</div>
                </div>
            </div>

            {{-- ADDRESS --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Address</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-6"><strong>Address:</strong> {{ $vendor->address ?? '—' }}</div>
                    <div class="col-md-3"><strong>Service Area:</strong> {{ $vendor->service_area ?? '—' }}</div>
                    <div class="col-md-3">
                        <strong>Google Map:</strong>
                        @if ($vendor->google_map)
                            <a href="{{ $vendor->google_map }}" target="_blank">View</a>
                        @else
                            —
                        @endif
                    </div>
                </div>
            </div>

            {{-- CATEGORY & PLAN --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Category & Plan</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-4">
                        <strong>Main Category:</strong>
                        {{ $vendor->mainCategory->name ?? 'N/A' }}
                    </div>

                    <div class="col-md-4">
                        <strong>Category:</strong>
                        {{ $vendor->category->name ?? 'N/A' }}
                    </div>

                    <div class="col-md-4">
                        <strong>Plan:</strong>
                        {{ $vendor->plan?->title ?? 'N/A' }}
                    </div>

                </div>

            </div>

            {{-- BUSINESS HOURS --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Business Hours</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-6"><strong>Opening:</strong> {{ $vendor->opening_time ?? '—' }}</div>
                    <div class="col-md-6"><strong>Closing:</strong> {{ $vendor->closing_time ?? '—' }}</div>
                </div>
            </div>

            {{-- PAYMENT --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Payment Details</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-4"><strong>Payment Mode:</strong> {{ $vendor->payment_mode }}</div>
                    <div class="col-md-4"><strong>Transaction ID:</strong> {{ $vendor->transaction_id ?? '—' }}</div>
                    <div class="col-md-4"><strong>Reference No:</strong> {{ $vendor->reference_number ?? '—' }}</div>
                </div>
            </div>

            {{-- IMAGES --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Gallery</h5>
                </div>
                <div class="card-body d-flex flex-wrap gap-2">
                    @if ($vendor->gallery)
                        @foreach ($vendor->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}" class="rounded" width="120">
                        @endforeach
                    @else
                        <span class="text-muted">No gallery images</span>
                    @endif
                </div>
            </div>

            {{-- ADMIN NOTES --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Admin Notes</h5>
                </div>
                <div class="card-body">
                    <p><strong>Special Recommendation:</strong><br>{{ $vendor->special_recommendation ?? '—' }}</p>
                    <p><strong>Internal Comments:</strong><br>{{ $vendor->internal_comments ?? '—' }}</p>
                </div>
            </div>

            {{-- META --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Meta Information</h5>
                </div>
                <div class="card-body row">
                    <div class="col-md-4"><strong>Created At:</strong> {{ $vendor->created_at }}</div>
                    <div class="col-md-4"><strong>Approved At:</strong> {{ $vendor->approved_at ?? '—' }}</div>
                    <div class="col-md-4"><strong>Created By:</strong>{{ $vendor->creator->name ?? 'N/A' }}</div>

                </div>
            </div>

        </div>
    </div>

@endsection
