@extends('layouts.salesman')

@section('title', 'Edit Vendor')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h5>Edit Vendor</h5>
        </div>

        <form action="{{ route('salesman.vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="row g-3">
                    {{-- Shop Name --}}
                    <div class="col-md-6">
                        <label class="form-label">Shop Name *</label>
                        <input type="text" name="shop_name" class="form-control"
                            value="{{ old('shop_name', $vendor->shop_name) }}" required>
                    </div>

                    {{-- Owner Name --}}
                    <div class="col-md-6">
                        <label class="form-label">Owner Name</label>
                        <input type="text" name="owner_name" class="form-control"
                            value="{{ old('owner_name', $vendor->owner_name) }}">
                    </div>

                    {{-- Mobile --}}
                    <div class="col-md-6">
                        <label class="form-label">Mobile *</label>
                        <input type="text" name="mobile" class="form-control"
                            value="{{ old('mobile', $vendor->mobile) }}" required>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="col-md-6">
                        <label class="form-label">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control"
                            value="{{ old('whatsapp', $vendor->whatsapp) }}">
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $vendor->email) }}">
                    </div>

                    {{-- DIGIPIN --}}
                    <div class="col-md-6">
                        <label class="form-label">DIGIPIN</label>
                        <input type="text" name="digipin" id="digipin" maxlength="10" class="form-control"
                            value="{{ old('digipin', $vendor->digipin) }}">
                        <small id="digipin_msg"></small>
                    </div>

                    {{-- Address --}}
                    <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address', $vendor->address) }}</textarea>
                    </div>

                    {{-- Google Map --}}
                    <div class="col-md-6">
                        <label class="form-label">Google Map URL</label>
                        <input type="url" name="google_map" class="form-control"
                            value="{{ old('google_map', $vendor->google_map) }}">
                    </div>

                    {{-- Service Area --}}
                    <div class="col-md-6">
                        <label class="form-label">Service Area</label>
                        <input type="text" name="service_area" class="form-control"
                            value="{{ old('service_area', $vendor->service_area) }}">
                    </div>

                    {{-- Main Category --}}
                    <div class="col-md-6">
                        <label class="form-label">Main Category *</label>
                        <select name="main_category_id" id="main_category" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($mainCategories as $main)
                                <option value="{{ $main->id }}" @selected($vendor->main_category_id == $main->id)>
                                    {{ $main->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sub Category --}}
                    <div class="col-md-6">
                        <label class="form-label">Category *</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" @selected($vendor->category_id == $cat->id)>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Plan --}}
                    <div class="col-md-6">
                        <label class="form-label">Plan *</label>
                        <select name="plan_id" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" @selected($vendor->plan_id == $plan->id)>
                                    {{ $plan->title }} (₹{{ $plan->amount }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Opening Time --}}
                    <div class="col-md-3">
                        <label class="form-label">Opening Time</label>
                        <input type="time" name="opening_time" class="form-control"
                            value="{{ old('opening_time', $vendor->opening_time) }}">
                    </div>

                    {{-- Closing Time --}}
                    <div class="col-md-3">
                        <label class="form-label">Closing Time</label>
                        <input type="time" name="closing_time" class="form-control"
                            value="{{ old('closing_time', $vendor->closing_time) }}">
                    </div>

                    {{-- Payment Mode --}}
                    <div class="col-md-6">
                        <label class="form-label">Payment Mode *</label>
                        <select name="payment_mode" id="payment_mode" class="form-select" required>
                            <option value="cash" @selected($vendor->payment_mode=='cash')>Cash</option>
                            <option value="gpay" @selected($vendor->payment_mode=='gpay')>GPay</option>
                            <option value="bank_transfer" @selected($vendor->payment_mode=='bank_transfer')>Bank Transfer</option>
                        </select>
                    </div>

                    {{-- Transaction ID --}}
                    <div class="col-md-6" id="transaction_box" @class(['d-none' => $vendor->payment_mode == 'cash'])>
                        <label class="form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id', $vendor->transaction_id) }}">
                    </div>

                    {{-- Reference Number --}}
                    <div class="col-md-12">
                        <label class="form-label">Reference Number</label>
                        <input type="text" name="reference_number" class="form-control" value="{{ old('reference_number', $vendor->reference_number) }}">
                    </div>

                    {{-- Denominations --}}
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Received Currency</label>
                        <div class="row g-2">
                            @foreach ([500,200,100,50,20,10] as $denom)
                            <div class="col-md-2">
                                <label>₹{{ $denom }}</label>
                                <input type="number" min="0" name="denominations[{{ $denom }}]"
                                    value="{{ old("denominations.$denom", $vendor->denominations[$denom] ?? 0) }}"
                                    class="form-control denomination-input">
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-2">
                            <strong>Total Amount: ₹<span id="totalAmount">0</span></strong>
                        </div>
                    </div>

                    {{-- Social Links --}}
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Social Links</label>
                        <div id="social-wrapper">
                            @if($vendor->social_links)
                                @foreach($vendor->social_links as $link)
                                    <div class="input-group mb-2">
                                        <input type="text" name="social_links[]" class="form-control" value="{{ $link }}" placeholder="Social Link URL">
                                        <button type="button" class="btn btn-danger remove-social"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-social"><i class="ri-add-line"></i> Add Social Link</button>
                    </div>

                    {{-- Profile Photo --}}
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        @if($vendor->photo)
                            <img src="{{ asset('storage/'.$vendor->photo) }}" class="img-thumbnail mt-2" width="120">
                        @endif
                    </div>

                    {{-- Gallery --}}
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Gallery</label>
                        <input type="file" name="gallery[]" id="gallery" multiple class="form-control">
                        <div class="d-flex gap-2 mt-2 flex-wrap">
                            @if($vendor->gallery)
                                @foreach($vendor->gallery as $img)
                                    <img src="{{ asset('storage/'.$img) }}" class="img-thumbnail" width="100">
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Comments --}}
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Special Recommendation</label>
                        <textarea name="special_recommendation" class="form-control">{{ old('special_recommendation', $vendor->special_recommendation) }}</textarea>

                        <label class="form-label mt-2">Internal Notes</label>
                        <textarea name="internal_comments" class="form-control">{{ old('internal_comments', $vendor->internal_comments) }}</textarea>
                    </div>

                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('salesman.vendor-list') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Vendor</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Payment toggle
    const paymentMode = document.getElementById('payment_mode');
    const transactionBox = document.getElementById('transaction_box');
    paymentMode.addEventListener('change', function() {
        transactionBox.classList.toggle('d-none', this.value === 'cash' || this.value === '');
    });

    // DIGIPIN validation
    const digipin = document.getElementById('digipin');
    const digipinMsg = document.getElementById('digipin_msg');
    digipin.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
        /^[A-Z0-9]{10}$/.test(this.value) ?
            (digipinMsg.textContent='Valid DIGIPIN', digipinMsg.className='text-success') :
            (digipinMsg.textContent='Invalid DIGIPIN', digipinMsg.className='text-danger');
    });

    // Denominations total
    const denomInputs = document.querySelectorAll('.denomination-input');
    const totalEl = document.getElementById('totalAmount');
    function updateTotal() {
        let total = 0;
        denomInputs.forEach(input => {
            const val = parseInt(input.value) || 0;
            const denom = parseInt(input.name.match(/\d+/)[0]);
            total += val * denom;
        });
        totalEl.textContent = total;
    }
    denomInputs.forEach(input => input.addEventListener('input', updateTotal));
    updateTotal();

    // Social links add/remove
    const socialWrapper = document.getElementById('social-wrapper');
    const addSocialBtn = document.getElementById('add-social');
    addSocialBtn.addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" name="social_links[]" class="form-control" placeholder="Social Link URL">
            <button type="button" class="btn btn-danger remove-social"><i class="ri-delete-bin-line"></i></button>
        `;
        socialWrapper.appendChild(div);
        div.querySelector('.remove-social').addEventListener('click', function(){ div.remove(); });
    });

});
</script>
@endpush
