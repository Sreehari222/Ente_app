@extends('layouts.deo')

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold mb-1">Edit Salesman</h4>
            <p class="text-muted mb-0">Update salesman details</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('salesmen.index') }}" class="btn btn-outline-secondary">
                <i class="ri-arrow-left-line"></i> Back
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('salesman.update', $salesman->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $salesman->name) }}"
                               required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $salesman->email) }}"
                               required>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Phone Number</label>
                        <input type="text"
                               name="phone_number"
                               class="form-control"
                               value="{{ old('phone_number', $salesman->phone_number) }}">
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Address</label>
                        <input type="text"
                               name="address"
                               class="form-control"
                               value="{{ old('address', $salesman->address) }}">
                    </div>

                    <!-- Account Number -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Account Number</label>
                        <input type="text"
                               name="account_number"
                               class="form-control"
                               value="{{ old('account_number', $salesman->account_number) }}">
                    </div>

                    <!-- IFSC -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">IFSC Code</label>
                        <input type="text"
                               name="ifsc_code"
                               class="form-control"
                               value="{{ old('ifsc_code', $salesman->ifsc_code) }}">
                    </div>

                    <!-- Role (Readonly) -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Role</label>
                        <input type="text"
                               class="form-control bg-light"
                               value="{{ ucfirst($salesman->role) }}"
                               readonly>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light">Reset</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-save-line"></i> Update Salesman
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
