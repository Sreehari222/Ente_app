@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">

        {{-- PAGE HEADER --}}
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <span class="badge bg-primary">{{ strtoupper($user->role) }}</span>
                </div>

                <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary btn-sm">
                    ← Back to Users
                </a>
            </div>
        </div>

        {{-- BASIC INFORMATION --}}
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="text-muted">User ID</label>
                        <div class="fw-semibold">{{ $user->id }}</div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-muted">Name</label>
                        <div class="fw-semibold">{{ $user->name }}</div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-muted">Email</label>
                        <div class="fw-semibold">{{ $user->email }}</div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-muted">Role</label>
                        <div>
                            <span class="badge bg-info">{{ ucfirst($user->role) }}</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-muted">Email Verification</label>
                        <div>
                            @if($user->email_verified_at)
                                <span class="badge bg-success">Verified</span>
                            @else
                                <span class="badge bg-danger">Not Verified</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- HIERARCHY INFORMATION --}}
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Hierarchy Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted">Area Operator</label>
                        <div class="fw-semibold">
                            {{ $user->areaOperator->name ?? '—' }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="text-muted">DEO</label>
                        <div class="fw-semibold">
                            {{ $user->deo->name ?? '—' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- META INFORMATION --}}
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Meta Information</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="text-muted">Created At</label>
                        <div class="fw-semibold">{{ $user->created_at }}</div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-muted">Updated At</label>
                        <div class="fw-semibold">{{ $user->updated_at }}</div>
                    </div>

                    <div class="col-md-4">
                        <label class="text-muted">Remember Token</label>
                        <div class="text-muted small text-break">
                            {{ $user->remember_token ?? '—' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
