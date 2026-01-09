@extends('layouts.admin')

@section('title', 'Edit Vendor')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">Edit Vendor</h4>
                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.vendors.update', $vendor->id) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- Shop Name --}}
                        <div class="mb-3">
                            <label class="form-label">Shop Name</label>
                            <input type="text" name="shop_name"
                                   class="form-control"
                                   value="{{ old('shop_name', $vendor->shop_name) }}">
                        </div>

                        {{-- Owner Name --}}
                        <div class="mb-3">
                            <label class="form-label">Owner Name</label>
                            <input type="text" name="owner_name"
                                   class="form-control"
                                   value="{{ old('owner_name', $vendor->owner_name) }}">
                        </div>

                        {{-- Mobile --}}
                        <div class="mb-3">
                            <label class="form-label">Mobile</label>
                            <input type="text" name="mobile"
                                   class="form-control"
                                   value="{{ old('mobile', $vendor->mobile) }}">
                        </div>

                        {{-- WhatsApp --}}
                        <div class="mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" name="whatsapp"
                                   class="form-control"
                                   value="{{ old('whatsapp', $vendor->whatsapp) }}">
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   value="{{ old('email', $vendor->email) }}">
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3">{{ old('address', $vendor->address) }}</textarea>
                        </div>

                        {{-- Google Map --}}
                        <div class="mb-3">
                            <label class="form-label">Google Map Link</label>
                            <input type="text" name="google_map"
                                   class="form-control"
                                   value="{{ old('google_map', $vendor->google_map) }}">
                        </div>

                        {{-- Service Area --}}
                        <div class="mb-3">
                            <label class="form-label">Service Area</label>
                            <input type="text" name="service_area"
                                   class="form-control"
                                   value="{{ old('service_area', $vendor->service_area) }}">
                        </div>

                        {{-- Opening & Closing Time --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Opening Time</label>
                                <input type="time" name="opening_time"
                                       class="form-control"
                                       value="{{ old('opening_time', $vendor->opening_time) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Closing Time</label>
                                <input type="time" name="closing_time"
                                       class="form-control"
                                       value="{{ old('closing_time', $vendor->closing_time) }}">
                            </div>
                        </div>

                        {{-- Payment Mode --}}
                        <div class="mb-3">
                            <label class="form-label">Payment Mode</label>
                            <select name="payment_mode" class="form-control">
                                <option value="">Select</option>
                                <option value="cash" {{ $vendor->payment_mode=='cash'?'selected':'' }}>Cash</option>
                                <option value="gpay" {{ $vendor->payment_mode=='gpay'?'selected':'' }}>GPay</option>
                                <option value="bank_transfer" {{ $vendor->payment_mode=='bank_transfer'?'selected':'' }}>Bank Transfer</option>
                            </select>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{ $vendor->status=='pending'?'selected':'' }}>Pending</option>
                                <option value="approved" {{ $vendor->status=='approved'?'selected':'' }}>Approved</option>
                                <option value="rejected" {{ $vendor->status=='rejected'?'selected':'' }}>Rejected</option>
                            </select>
                        </div>

                        {{-- Internal Comments --}}
                        <div class="mb-3">
                            <label class="form-label">Internal Comments</label>
                            <textarea name="internal_comments" class="form-control" rows="3">{{ old('internal_comments', $vendor->internal_comments) }}</textarea>
                        </div>

                        {{-- Buttons --}}
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                Update Vendor
                            </button>

                            <a href="{{ route('admin.vendors.index') }}"
                               class="btn btn-secondary ms-2">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
