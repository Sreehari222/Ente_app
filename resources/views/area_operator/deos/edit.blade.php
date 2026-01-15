@extends('layouts.area_operator')

@section('title', 'Edit DEO')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit DEO</h4>
        <a href="{{ route('area.deo.index') }}" class="btn btn-secondary">
            <i class="ri-arrow-left-line"></i> Back
        </a>
    </div>

    <form action="{{ route('area.deo.update', $deo->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- BASIC INFO --}}
        <div class="card mb-4">
            <div class="card-header">Basic Information</div>
            <div class="card-body row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name"
                        value="{{ old('name', $deo->name) }}"
                        class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $deo->email) }}"
                        class="form-control" required>
                </div>

            </div>
        </div>

        {{-- CONTACT INFO --}}
        <div class="card mb-4">
            <div class="card-header">Contact Information</div>
            <div class="card-body row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone_number"
                        value="{{ old('phone_number', $deo->phone_number) }}"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address"
                        value="{{ old('address', $deo->address) }}"
                        class="form-control">
                </div>

            </div>
        </div>

        {{-- BANK DETAILS --}}
        <div class="card mb-4">
            <div class="card-header">Bank Details</div>
            <div class="card-body row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Account Number</label>
                    <input type="text" name="account_number"
                        value="{{ old('account_number', $deo->account_number) }}"
                        class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">IFSC Code</label>
                    <input type="text" name="ifsc_code"
                        value="{{ old('ifsc_code', $deo->ifsc_code) }}"
                        class="form-control">
                </div>

            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="text-end">
            <button class="btn btn-primary">
                <i class="ri-save-line"></i> Update DEO
            </button>
        </div>

    </form>

</div>
@endsection
