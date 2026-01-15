@extends('layouts.area_operator')

@section('content')
<div class="container-fluid">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Vendor Details</h4>
        <a href="{{ route('area.vendors.index') }}" class="btn btn-secondary btn-sm">
            ← Back to Vendors
        </a>
    </div>

    {{-- BASIC INFO --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Basic Information</div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr><th width="30%">Shop Name</th><td>{{ $vendor->shop_name }}</td></tr>
                <tr><th>Owner Name</th><td>{{ $vendor->owner_name ?? '-' }}</td></tr>
                <tr><th>Mobile</th><td>{{ $vendor->mobile }}</td></tr>
                <tr><th>WhatsApp</th><td>{{ $vendor->whatsapp ?? '-' }}</td></tr>
                <tr><th>Email</th><td>{{ $vendor->email ?? '-' }}</td></tr>
            </table>
        </div>
    </div>

    {{-- LOCATION --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Location Details</div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr><th width="30%">Address</th><td>{{ $vendor->address ?? '-' }}</td></tr>
                <tr><th>Service Area</th><td>{{ $vendor->service_area ?? '-' }}</td></tr>
                <tr>
                    <th>Google Map</th>
                    <td>
                        @if($vendor->google_map)
                            <a href="{{ $vendor->google_map }}" target="_blank">View on Map</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- BUSINESS DETAILS --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Business Details</div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr><th width="30%">Main Category</th><td>{{ $vendor->main_category_id }}</td></tr>
                <tr><th>Category</th><td>{{ $vendor->category_id }}</td></tr>
                <tr><th>Plan</th><td>{{ $vendor->plan_id }}</td></tr>
                <tr><th>Opening Time</th><td>{{ $vendor->opening_time ?? '-' }}</td></tr>
                <tr><th>Closing Time</th><td>{{ $vendor->closing_time ?? '-' }}</td></tr>
            </table>
        </div>
    </div>

    {{-- MEDIA --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Media</div>
        <div class="card-body">

            {{-- PROFILE PHOTO --}}
            @if($vendor->photo)
                <div class="mb-3">
                    <strong>Profile Photo</strong><br>
                    <img src="{{ asset('storage/'.$vendor->photo) }}"
                         class="img-thumbnail mt-2"
                         width="180">
                </div>
            @endif

            {{-- GALLERY --}}
            @if($vendor->gallery)
                <strong>Gallery</strong>
                <div class="d-flex flex-wrap mt-2">
                    @foreach($vendor->gallery as $img)
                        <img src="{{ asset('storage/'.$img) }}"
                             class="img-thumbnail me-2 mb-2"
                             width="120">
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">No gallery images</p>
            @endif

        </div>
    </div>

    {{-- PAYMENT --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Payment Details</div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr><th width="30%">Payment Mode</th><td>{{ ucfirst($vendor->payment_mode) }}</td></tr>
                <tr><th>Total Amount</th><td>₹ {{ $vendor->total_amount }}</td></tr>
                <tr><th>Transaction ID</th><td>{{ $vendor->transaction_id ?? '-' }}</td></tr>
                <tr><th>Reference Number</th><td>{{ $vendor->reference_number ?? '-' }}</td></tr>
            </table>

            {{-- DENOMINATIONS --}}
            @if($vendor->denominations)
                <h6 class="mt-3">Denominations</h6>
                <table class="table table-sm table-bordered w-50">
                    <thead>
                        <tr>
                            <th>Denomination</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendor->denominations as $amount => $count)
                            <tr>
                                <td>₹ {{ $amount }}</td>
                                <td>{{ $count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- STATUS --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Status</div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr>
                    <th width="30%">Current Status</th>
                    <td>
                        <span class="badge
                            {{ $vendor->status === 'approved' ? 'bg-success' :
                               ($vendor->status === 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                            {{ ucfirst($vendor->status) }}
                        </span>
                    </td>
                </tr>
                <tr><th>Approved At</th><td>{{ $vendor->approved_at ?? '-' }}</td></tr>
            </table>
        </div>
    </div>

    {{-- INTERNAL --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Internal Notes</div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr><th width="30%">Special Recommendation</th><td>{{ $vendor->special_recommendation ?? '-' }}</td></tr>
                <tr><th>Internal Comments</th><td>{{ $vendor->internal_comments ?? '-' }}</td></tr>
            </table>
        </div>
    </div>

    {{-- META --}}
    <div class="card mb-4">
        <div class="card-header fw-bold">Meta Information</div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr><th width="30%">Salesman</th><td>{{ $vendor->salesman->name ?? 'N/A' }}</td></tr>
                <tr><th>Created At</th><td>{{ $vendor->created_at }}</td></tr>
                <tr><th>Last Updated</th><td>{{ $vendor->updated_at }}</td></tr>
            </table>
        </div>
    </div>

</div>
@endsection
