@extends('layouts.area_operator')

@section('title', 'Salesman Details')

@section('content')
    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Salesman Details</h4>
            <a href="{{ route('area.salesmen.index') }}" class="btn btn-outline-secondary">
                Back
            </a>
        </div>

        {{-- Basic Information --}}
        <div class="card mb-4">
            <div class="card-header">Basic Information</div>
            <div class="card-body row">
                <div class="col-md-6 mb-2"><strong>ID:</strong> {{ $salesman->id }}</div>
                <div class="col-md-6 mb-2"><strong>Name:</strong> {{ $salesman->name }}</div>
                <div class="col-md-6 mb-2"><strong>Email:</strong> {{ $salesman->email }}</div>
                <div class="col-md-6 mb-2"><strong>Phone:</strong> {{ $salesman->phone_number ?? '-' }}</div>
                <div class="col-md-12 mb-2"><strong>Address:</strong> {{ $salesman->address ?? '-' }}</div>
            </div>
        </div>

        {{-- Profile & Cover Photos --}}
        <div class="card mb-4">
            <div class="card-header">Profile & Cover Photos</div>
            <div class="card-body row">
                <div class="col-md-6 mb-2">
                    <strong>Profile Photo:</strong><br>
                    @if ($salesman->profile_photo)
                        <img src="{{ asset($salesman->profile_photo) }}" alt="Profile Photo" class="img-fluid rounded"
                            style="max-height:150px;">
                    @else
                        N/A
                    @endif
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Cover Photo:</strong><br>
                    @if ($salesman->cover_photo)
                        <img src="{{ asset($salesman->cover_photo) }}" alt="Cover Photo" class="img-fluid rounded"
                            style="max-height:150px;">
                    @else
                        N/A
                    @endif
                </div>
            </div>
        </div>

        {{-- Bank Details --}}
        <div class="card mb-4">
            <div class="card-header">Bank Details</div>
            <div class="card-body row">
                <div class="col-md-6 mb-2"><strong>Account Number:</strong> {{ $salesman->account_number ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>IFSC Code:</strong> {{ $salesman->ifsc_code ?? '-' }}</div>
            </div>
        </div>

        {{-- System Information --}}
        <div class="card mb-4">
            <div class="card-header">Team Information</div>
            <div class="card-body row">
                <div class="col-md-6 mb-2"><strong>Role:</strong> {{ $salesman->role }}</div>
                <div class="col-md-6 mb-2"><strong>DEO Name:</strong> {{ $salesman->deo->name ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>Area Operator Name:</strong> {{ $salesman->areaOperator->name ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>Email Verified At:</strong> {{ $salesman->email_verified_at ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Login & Timestamp Information --}}
        <div class="card mb-4">
            <div class="card-header">Login & Timestamps</div>
            <div class="card-body row">
                <div class="col-md-6 mb-2"><strong>Last Login:</strong> {{ $salesman->last_login_at ?? 'Never' }}</div>
                <div class="col-md-6 mb-2"><strong>Last Logout:</strong> {{ $salesman->last_logout_at ?? 'Never' }}</div>
                <div class="col-md-6 mb-2"><strong>Created At:</strong> {{ $salesman->created_at }}</div>
                <div class="col-md-6 mb-2"><strong>Updated At:</strong> {{ $salesman->updated_at }}</div>
            </div>
        </div>

    </div>
@endsection
