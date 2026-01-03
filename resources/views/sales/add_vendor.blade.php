@extends('layouts.sales')

@section('title', 'Add Vendor')

@section('content')
    @if (session('success'))
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "{{ session('success') }}",
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endpush
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fix the errors and try again'
            });
        </script>
    @endif



    <form action="" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ================= SHOP DETAILS ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-store-2-line me-1"></i> Shop Details</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Shop Name *</label>
                        <input type="text" name="shop_name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Owner Name</label>
                        <input type="text" name="owner_name" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mobile *</label>
                        <input type="tel" name="mobile" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">WhatsApp</label>
                        <input type="tel" name="whatsapp" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">DIGIPIN</label>
                        <input type="text" name="digipin" id="digipin" maxlength="10" class="form-control">
                        <small id="digipin_msg"></small>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Google Map URL</label>
                        <input type="url" name="google_map" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Service Area</label>
                        <input type="text" name="service_area" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= CATEGORY & PLAN ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-list-check-2 me-1"></i> Category & Plan</h5>

                <div class="row g-3">
                    {{-- Main Category --}}
                    <div class="col-md-6">
                        <label class="form-label">Main Category <span class="text-danger">*</span></label>
                        <select name="main_category_id" id="main_category" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($mainCategories as $main)
                                <option value="{{ $main->id }}">{{ $main->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category --}}
                    <div class="col-md-6">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select" required disabled>
                            <option value="">Select</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Plan <span class="text-danger">*</span></label>
                        <select name="plan_id" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->title }} - ₹{{ $plan->amount }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TIMINGS ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-time-line me-1"></i> Working Hours</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Opening Time</label>
                        <input type="time" name="opening_time" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Closing Time</label>
                        <input type="time" name="closing_time" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= SOCIAL MEDIA ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-share-line me-1"></i> Social Media</h5>

                <div id="social-wrapper"></div>

                <button type="button" class="btn btn-sm btn-outline-primary" id="add-social">
                    <i class="ri-add-line"></i> Add Social Link
                </button>
            </div>
        </div>

        {{-- ================= IMAGES ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-image-line me-1"></i> Images</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                        <img id="photoPreview" class="img-thumbnail mt-2 d-none" width="120">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gallery</label>
                        <input type="file" name="gallery[]" id="gallery" multiple class="form-control">
                        <div id="galleryPreview" class="d-flex gap-2 mt-2 flex-wrap"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= PAYMENT ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-bank-card-line me-1"></i> Payment</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Payment Mode *</label>
                        <select name="payment_mode" id="payment_mode" class="form-select" required>
                            <option value="">Select</option>
                            <option value="gpay">GPay</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>

                    <div class="col-md-6 d-none" id="transaction_box">
                        <label class="form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Reference Number</label>
                        <input type="text" name="reference_number" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= COMMENTS ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-chat-quote-line me-1"></i> Comments</h5>

                <textarea name="special_recommendation" class="form-control mb-2" rows="2"
                    placeholder="Special Recommendation"></textarea>
                <textarea name="internal_comments" class="form-control" rows="2" placeholder="Internal Notes"></textarea>
            </div>
        </div>

        <button class="btn btn-primary btn-lg w-100">
            <i class="ri-save-line"></i> Save Vendor
        </button>

    </form>
@endsection

@push('scripts')
    <script>
        /* SOCIAL */
        document.getElementById('add-social').addEventListener('click', () => {
            document.getElementById('social-wrapper').insertAdjacentHTML('beforeend', `
    <div class="row g-2 mb-2 social-row">
        <div class="col-md-4">
            <select name="social_type[]" class="form-select">
                <option value="instagram">Instagram</option>
                <option value="facebook">Facebook</option>
                <option value="website">Website</option>
            </select>
        </div>
        <div class="col-md-7">
            <input type="url" name="social_link[]" class="form-control">
        </div>
        <div class="col-md-1 text-end">
            <button type="button" class="btn btn-danger remove-social"><i class="ri-close-line"></i></button>
        </div>
    </div>`);
        });

        document.addEventListener('click', e => {
            if (e.target.closest('.remove-social')) {
                e.target.closest('.social-row').remove();
            }
        });

        /* DIGIPIN */
        document.getElementById('digipin').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
            const msg = document.getElementById('digipin_msg');
            /^[A-Z0-9]{10}$/.test(this.value) ?
                (msg.textContent = 'Valid DIGIPIN', msg.className = 'text-success') :
                (msg.textContent = 'Invalid DIGIPIN', msg.className = 'text-danger');
        });

        /* PAYMENT TOGGLE */
        document.getElementById('payment_mode').addEventListener('change', function() {
            document.getElementById('transaction_box').classList.toggle(
                'd-none', this.value === 'cash' || this.value === ''
            );
        });

        /* IMAGE PREVIEW */
        photo.onchange = e => {
            photoPreview.src = URL.createObjectURL(e.target.files[0]);
            photoPreview.classList.remove('d-none');
        };

        gallery.onchange = e => {
            galleryPreview.innerHTML = '';
            [...e.target.files].forEach(f => {
                let img = document.createElement('img');
                img.src = URL.createObjectURL(f);
                img.className = 'img-thumbnail';
                img.style.width = '90px';
                galleryPreview.appendChild(img);
            });
        };
        // Load categories dynamically
        document.getElementById('main_category').addEventListener('change', function() {
            fetch(`/provider/sub-categories/by-main/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    const cat = document.getElementById('category_id');
                    cat.innerHTML = '<option value="">Select</option>';
                    cat.disabled = false;

                    data.forEach(d => {
                        cat.innerHTML += `<option value="${d.id}">${d.name}</option>`;
                    });
                });
        });
    </script>
@endpush