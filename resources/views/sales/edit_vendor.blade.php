@extends('layouts.sales')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h5>Edit Vendor</h5>
        </div>

        <form action="{{ route('salesman.vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body row">

                {{-- Shop Name --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Shop Name</label>
                    <input type="text" name="shop_name" class="form-control"
                        value="{{ old('shop_name', $vendor->shop_name) }}">
                </div>

                {{-- Owner Name --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Owner Name</label>
                    <input type="text" name="owner_name" class="form-control"
                        value="{{ old('owner_name', $vendor->owner_name) }}">
                </div>

                {{-- Mobile --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="mobile" class="form-control"
                        value="{{ old('mobile', $vendor->mobile) }}">
                </div>

                {{-- WhatsApp --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control"
                        value="{{ old('whatsapp', $vendor->whatsapp) }}">
                </div>

                {{-- Email --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $vendor->email) }}">
                </div>

                {{-- Address --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control">{{ old('address', $vendor->address) }}</textarea>
                </div>

                {{-- Google Map --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Google Map Link</label>
                    <input type="url" name="google_map" class="form-control"
                        value="{{ old('google_map', $vendor->google_map) }}">
                </div>

                {{-- Service Area --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Service Area</label>
                    <input type="text" name="service_area" class="form-control"
                        value="{{ old('service_area', $vendor->service_area) }}">
                </div>

                {{-- Main Category --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Main Category</label>
                    <select name="main_category_id" class="form-select">
                        @foreach($mainCategories as $main)
                            <option value="{{ $main->id }}"
                                @selected($vendor->main_category_id == $main->id)>
                                {{ $main->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Category --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                @selected($vendor->category_id == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Plan --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Plan</label>
                    <select name="plan_id" class="form-select">
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}"
                                @selected($vendor->plan_id == $plan->id)>
                                {{ $plan->name }} (₹{{ $plan->amount }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Opening Time --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Opening Time</label>
                    <input type="time" name="opening_time" class="form-control"
                        value="{{ old('opening_time', $vendor->opening_time) }}">
                </div>

                {{-- Closing Time --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">Closing Time</label>
                    <input type="time" name="closing_time" class="form-control"
                        value="{{ old('closing_time', $vendor->closing_time) }}">
                </div>

                {{-- Payment Mode --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Mode</label>
                    <select name="payment_mode" class="form-select">
                        <option value="cash" @selected($vendor->payment_mode=='cash')>Cash</option>
                        <option value="gpay" @selected($vendor->payment_mode=='gpay')>GPay</option>
                        <option value="bank_transfer" @selected($vendor->payment_mode=='bank_transfer')>Bank Transfer</option>
                    </select>
                </div>

                {{-- Status (readonly for salesman) --}}
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" value="{{ ucfirst($vendor->status) }}" readonly>
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('sales.vendors.index') }}" class="btn btn-secondary">Back</a>
                <button class="btn btn-primary">Update Vendor</button>
            </div>

        </form>
    </div>

</div>
@endsection
