@extends('layouts.salesman')

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

    <form action="{{ route('salesman.vendors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ================= SHOP DETAILS ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-store-2-line me-1"></i> Shop/Services Details</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Shop Name/Service Name *</label>
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
                    <div class="col-md-6">
                        <label class="form-label">Main Category <span class="text-danger">*</span></label>
                        <select name="main_category_id" id="main_category" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($mainCategories as $main)
                                <option value="{{ $main->id }}">{{ $main->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select" required disabled>
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Plan <span class="text-danger">*</span></label>
                        <select name="plan_id" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" data-amount="{{ $plan->amount }}">
                                    {{ $plan->title }} - ₹{{ $plan->amount }}
                                </option>
                            @endforeach
                        </select>

                        <div class="col-12 mt-3 d-none" id="emi_box">
                            <div class="card p-3 border border-primary">
                                <h6>EMI Option</h6>
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-6">
                                        <label class="form-label">Select EMI Duration (Months)</label>
                                        <select id="emi_duration" name="emi_duration" class="form-select">
                                            <option value="">Select</option>
                                            <option value="3">3 Months</option>
                                            <option value="6">6 Months</option>
                                            <option value="9">9 Months</option>
                                            <option value="12">12 Months</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Amount per EMI</label>
                                        <input type="text" name="emi_amount" id="emi_amount" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

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

        {{-- ================= PAYMENT & DENOMINATIONS ================= --}}
        {{-- ================= PAYMENT & DENOMINATIONS ================= --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4"><i class="ri-bank-card-line me-1"></i> Payment</h5>
                <div class="row g-3">

                    {{-- Payment Mode --}}
                    <div class="col-md-6">
                        <label class="form-label">Payment Mode *</label>
                        <select name="payment_mode" id="payment_mode" class="form-select" required>
                            <option value="">Select</option>
                            <option value="gpay">GPay</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>

                    {{-- Transaction ID --}}
                    <div class="col-md-6 d-none" id="transaction_box">
                        <label class="form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control">
                    </div>

                    {{-- Reference Number --}}
                    <div class="col-md-12">
                        <label class="form-label">Reference Number</label>
                        <input type="text" name="reference_number" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control">
                    </div>

                    {{-- Denominations (only visible if Cash) --}}
                    <div class="col-12 mt-3 d-none" id="denominations_box">
                        <label class="form-label">Received Currency</label>
                        <div class="row g-2">
                            @foreach ([500, 200, 100, 50, 20, 10] as $denomination)
                                <div class="col-md-2">
                                    <label class="form-label">₹{{ $denomination }}</label>
                                    <input type="number" min="0" name="denominations[{{ $denomination }}]"
                                        value="0" class="form-control denomination-input">
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <strong>Total Amount: ₹<span id="totalAmount">0</span></strong>
                        </div>
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

        <button class="btn btn-primary btn-lg w-100"><i class="ri-save-line"></i> Save Vendor</button>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ========== SUBCATEGORY DYNAMIC ==========
            const mainCategory = document.getElementById('main_category');
            const subCategory = document.getElementById('category_id');

            mainCategory.addEventListener('change', function() {
                const parentId = this.value;
                subCategory.innerHTML = '<option value="">Select</option>';
                subCategory.disabled = true;
                if (!parentId) return;

                fetch(`{{ route('get-sub-categories', ':id') }}`.replace(':id', parentId))
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.name;
                            subCategory.appendChild(option);
                        });
                        subCategory.disabled = false;
                    })
                    .catch(() => alert('Unable to load sub categories'));
            });

            // ========== DIGIPIN ==========
            document.getElementById('digipin').addEventListener('input', function() {
                this.value = this.value.toUpperCase();
                const msg = document.getElementById('digipin_msg');
                /^[A-Z0-9]{10}$/.test(this.value) ?
                    (msg.textContent = 'Valid DIGIPIN', msg.className = 'text-success') :
                    (msg.textContent = 'Invalid DIGIPIN', msg.className = 'text-danger');
            });

            // ========== PAYMENT MODE ==========
            document.getElementById('payment_mode').addEventListener('change', function() {
                document.getElementById('transaction_box').classList.toggle('d-none', this.value ===
                    'cash' || this.value === '');
            });

            // ========== DENOMINATIONS TOTAL ==========
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

            // ========== SOCIAL LINKS ==========
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

                // Remove button
                div.querySelector('.remove-social').addEventListener('click', function() {
                    div.remove();
                });
            });
        });

        // ========== PAYMENT MODE TOGGLE ==========
        const paymentMode = document.getElementById('payment_mode');
        const transactionBox = document.getElementById('transaction_box');
        const denominationsBox = document.getElementById('denominations_box');

        paymentMode.addEventListener('change', function() {
            const isCash = this.value === 'cash';
            transactionBox.classList.toggle('d-none', !
                isCash); // hide transaction if cash? Actually for cash, transaction not needed
            denominationsBox.classList.toggle('d-none', !isCash); // show denominations only if cash
        });


        // ========== EMI CALCULATION ==========
        const planSelect = document.querySelector('select[name="plan_id"]');
        const emiBox = document.getElementById('emi_box');
        const emiDuration = document.getElementById('emi_duration');
        const emiAmount = document.getElementById('emi_amount');

        planSelect.addEventListener('change', function() {
            const selectedOption = this.selectedOptions[0];
            const planAmount = parseFloat(selectedOption.dataset.amount) || 0;

            if (planAmount > 0) {
                emiBox.classList.remove('d-none');
                // reset EMI duration and amount
                emiDuration.value = '';
                emiAmount.value = '';
            } else {
                emiBox.classList.add('d-none');
                emiDuration.value = '';
                emiAmount.value = '';
            }
        });

        emiDuration.addEventListener('change', function() {
            const duration = parseInt(this.value) || 0;
            const selectedOption = planSelect.selectedOptions[0];
            const planAmount = parseFloat(selectedOption.dataset.amount) || 0;

            if (duration > 0 && planAmount > 0) {
                const perEmi = (planAmount / duration).toFixed(2);
                emiAmount.value = perEmi;
            } else {
                emiAmount.value = '';
            }
        });
    </script>
@endpush
