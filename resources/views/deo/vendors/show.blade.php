@extends('layouts.deo')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Vendor Details</h4>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm">
            <i class="ri-arrow-left-line"></i> Back
        </a>
    </div>

    <!-- Top Section: Profile + Status & Contact Info -->
    <div class="row mb-4">
        <!-- Profile + Status -->
        <div class="col-lg-6 mb-3 d-flex">
            <div class="card shadow-sm border-0 flex-fill d-flex flex-column">
                <div class="card-body text-center">
                    <img src="{{ $vendor->photo ? asset($vendor->photo) : 'https://via.placeholder.com/100' }}" alt="Vendor Photo" class="rounded-circle mb-2" width="100">
                    <h5 class="fw-bold">{{ $vendor->shop_name }}</h5>
                    <div>{{ $vendor->owner_name }}</div>
                    <span class="badge bg-warning mt-2">{{ ucfirst($vendor->status) }}</span>
                </div>
            </div>
        </div>

        <!-- Contact & System Info -->
        <div class="col-lg-6 mb-3 d-flex">
            <div class="card shadow-sm border-0 flex-fill">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Contact & System Info</h6>
                    <div class="row">
                        <div class="col-md-6"><small class="text-muted">Mobile</small><div>{{ $vendor->mobile ?? '-' }}</div></div>
                        <div class="col-md-6"><small class="text-muted">Added By</small><div>{{ $vendor->added_by_name ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Address</small><div>{{ $vendor->address ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Joined At</small><div>{{ $vendor->created_at->format('d M Y') }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Middle Section: Basic Info & Financial Info -->
    <div class="row mb-4">
        <!-- Basic Information -->
        <div class="col-lg-6 mb-3 d-flex">
            <div class="card shadow-sm border-0 flex-fill">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Basic Information</h6>
                    <div class="row">
                        <div class="col-md-6"><small class="text-muted">Mobile</small><div>{{ $vendor->mobile ?? '-' }}</div></div>
                        <div class="col-md-6"><small class="text-muted">WhatsApp</small><div>{{ $vendor->whatsapp ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Email</small><div>{{ $vendor->email ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">DigiPin</small><div>{{ $vendor->digipin ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Address</small><div>{{ $vendor->address ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Google Map</small><div>
                            <a href="{{ $vendor->google_map ?? '#' }}" target="_blank">{{ $vendor->google_map ?? '-' }}</a>
                        </div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Service Area</small><div>{{ $vendor->service_area ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Category</small><div>{{ $vendor->category->name ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Opening Time</small><div>{{ $vendor->opening_time ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Closing Time</small><div>{{ $vendor->closing_time ?? '-' }}</div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial & System Info -->
        <div class="col-lg-6 mb-3 d-flex">
            <div class="card shadow-sm border-0 flex-fill">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Financial & System Info</h6>
                    <div class="row">
                        <div class="col-md-6"><small class="text-muted">Payment Mode</small><div>{{ $vendor->payment_mode ?? '-' }}</div></div>
                        <div class="col-md-6"><small class="text-muted">Account Number</small><div>{{ $vendor->account_number ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">IFSC Code</small><div>{{ $vendor->ifsc_code ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Total Amount</small><div>{{ $vendor->total_amount ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Transaction ID</small><div>{{ $vendor->transaction_id ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Reference Number</small><div>{{ $vendor->reference_number ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Created By</small><div>{{ $vendor->created_by_name ?? '-' }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Joined At</small><div>{{ $vendor->created_at->format('d M Y') }}</div></div>
                        <div class="col-md-6 mt-2"><small class="text-muted">Updated At</small><div>{{ $vendor->updated_at->format('d M Y') }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Additional Info -->
    <div class="row">
        <div class="col-12 d-flex">
            <div class="card shadow-sm border-0 flex-fill">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Additional Info</h6>
                    <div class="row">
                        <div class="col-md-6"><small class="text-muted">Special Recommendation</small><div>{{ $vendor->special_recommendation ?? '-' }}</div></div>
                        <div class="col-md-6"><small class="text-muted">Internal Comments</small><div>{{ $vendor->internal_comments ?? '-' }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
