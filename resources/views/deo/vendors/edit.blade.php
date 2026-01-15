@extends('layouts.deo')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Edit Vendor</h4>
            <a href="{{ route('vendors.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('deo.vendors.update', $vendor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- PROFILE & STATUS --}}
                    <div class="mb-4 d-flex align-items-center">
                        <div class="me-3">
                            <img src="{{ $vendor->photo ? asset('storage/' . $vendor->photo) : asset('images/default_vendor.png') }}"
                                alt="Vendor Photo" class="rounded" width="80">
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $vendor->shop_name }}</h5>
                            <small>{{ $vendor->owner_name }}</small><br>
                            <span
                                class="badge
                        {{ $vendor->status == 'pending' ? 'bg-warning' : ($vendor->status == 'active' ? 'bg-success' : 'bg-danger') }}">
                                {{ ucfirst($vendor->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-4">
                        {{-- CONTACT & SYSTEM INFO --}}
                        <div class="col-md-6">
                            <div class="card p-3 h-100">
                                <h6 class="fw-bold mb-3">Contact & System Info</h6>
                                <div class="mb-2">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" name="mobile" class="form-control"
                                        value="{{ old('mobile', $vendor->mobile) }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control" rows="2">{{ old('address', $vendor->address) }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Added By</label>
                                    <input type="text" class="form-control" value="{{ $vendor->creator->name ?? '-' }}"
                                        readonly>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Joined At</label>
                                    <input type="text" class="form-control"
                                        value="{{ $vendor->created_at->format('d M Y') }}" readonly>
                                </div>
                            </div>
                        </div>

                        {{-- FINANCIAL & SYSTEM INFO --}}
                        <div class="col-md-6">
                            <div class="card p-3 h-100">
                                <h6 class="fw-bold mb-3">Financial & System Info</h6>
                                <div class="mb-2">
                                    <label class="form-label">Payment Mode</label>
                                    <input type="text" name="payment_mode" class="form-control"
                                        value="{{ old('payment_mode', $vendor->payment_mode) }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Transaction ID</label>
                                    <input type="text" name="transaction_id" class="form-control"
                                        value="{{ old('transaction_id', $vendor->transaction_id) }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Total Amount</label>
                                    <input type="text" name="total_amount" class="form-control"
                                        value="{{ old('total_amount', $vendor->total_amount) }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Reference Number</label>
                                    <input type="text" name="reference_number" class="form-control"
                                        value="{{ old('reference_number', $vendor->reference_number) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BASIC INFORMATION --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card p-3 h-100">
                                <h6 class="fw-bold mb-3">Basic Information</h6>
                                <div class="mb-2">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="text" name="whatsapp" class="form-control"
                                        value="{{ old('whatsapp', $vendor->whatsapp) }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">DigiPin</label>
                                    <input type="text" name="digipin" class="form-control"
                                        value="{{ old('digipin', $vendor->digipin) }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Google Map</label>
                                    <input type="text" name="google_map" class="form-control"
                                        value="{{ old('google_map', $vendor->google_map) }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Service Area</label>
                                    <input type="text" name="service_area" class="form-control"
                                        value="{{ old('service_area', $vendor->service_area) }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Main Category</label>
                                    <input type="text" class="form-control"
                                        value="{{ $vendor->mainCategory->name ?? '-' }}" readonly>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label">Category</label>
                                    <input type="text" class="form-control"
                                        value="{{ $vendor->category->name ?? '-' }}" readonly>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Opening Time</label>
                                        <input type="time" name="opening_time" class="form-control"
                                            value="{{ old('opening_time', $vendor->opening_time) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Closing Time</label>
                                        <input type="time" name="closing_time" class="form-control"
                                            value="{{ old('closing_time', $vendor->closing_time) }}">
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- ADDITIONAL INFO --}}
                        <div class="col-md-6">
                            <div class="card p-3 h-100">
                                <h6 class="fw-bold mb-3">Additional Info</h6>
                                <div class="mb-2">
                                    <label class="form-label">Special Recommendation</label>
                                    <textarea name="special_recommendation" class="form-control" rows="3">{{ old('special_recommendation', $vendor->special_recommendation) }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Internal Comments</label>
                                    <textarea name="internal_comments" class="form-control" rows="3">{{ old('internal_comments', $vendor->internal_comments) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Vendor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
