@extends('layouts.deo')

@section('content')
    <div class="container-fluid">

        {{-- Page Title --}}
        <div class="row mb-3">
            <div class="col">
                <h4 class="mb-0">Salesman Details</h4>
                <small class="text-muted">View complete salesman information</small>
            </div>
            <div class="col text-end">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
                    <i class="ri-arrow-left-line"></i> Back
                </a>

                <a href="{{ route('salesmen.edit', $salesman->id) }}" class="btn btn-sm btn-primary">
                    <i class="ri-edit-line"></i> Edit
                </a>
            </div>
        </div>

        {{-- Card --}}
        <div class="card">
            <div class="card-body">

                <div class="row g-4">

                    {{-- Basic Info --}}
                    <div class="col-md-6">
                        <h6 class="fw-semibold border-bottom pb-2 mb-3">Basic Information</h6>

                        <p><strong>Name:</strong> {{ $salesman->name }}</p>
                        <p><strong>Email:</strong> {{ $salesman->email }}</p>
                        <p><strong>Role:</strong>
                            <span class="badge bg-info text-dark">
                                {{ ucfirst($salesman->role) }}
                            </span>
                        </p>
                    </div>

                    {{-- Hierarchy Info --}}
                    <div class="col-md-6">
                        <h6 class="fw-semibold border-bottom pb-2 mb-3">Hierarchy</h6>

                        <p>
                            <strong>DEO:</strong>
                            {{ $salesman->deo?->name ?? 'N/A' }}
                        </p>

                        <p>
                            <strong>Area Operator:</strong>
                            {{ $salesman->areaOperator?->name ?? 'N/A' }}
                        </p>
                    </div>

                    {{-- Meta Info --}}
                    <div class="col-md-12">
                        <h6 class="fw-semibold border-bottom pb-2 mb-3">Account Info</h6>

                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>User ID:</strong> #{{ $salesman->id }}</p>
                            </div>

                            <div class="col-md-4">
                                <p>
                                    <strong>Email Verified:</strong>
                                    @if ($salesman->email_verified_at)
                                        <span class="text-success">Verified</span>
                                    @else
                                        <span class="text-danger">Not Verified</span>
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-4">
                                <p>
                                    <strong>Joined On:</strong>
                                    {{ $salesman->created_at->format('d M Y, h:i A') }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
