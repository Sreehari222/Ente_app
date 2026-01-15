@extends('layouts.area_operator')

@section('title', 'DEO Details')

@section('content')
<div class="container-fluid">

    {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ route('area.deo.index') }}" class="btn btn-secondary">
            <i class="ri-arrow-left-line"></i> Back to DEOs
        </a>
    </div>

    {{-- BASIC INFO --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Basic Information</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th width="30%">Name</th>
                    <td>{{ $deo->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $deo->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>
                        <span class="badge bg-info text-uppercase">
                            {{ $deo->role }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- CONTACT INFO --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Contact Information</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th width="30%">Phone Number</th>
                    <td>{{ $deo->phone_number ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $deo->address ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- BANK & ASSIGNMENT --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Bank & Assignment Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th width="30%">Account Number</th>
                    <td>{{ $deo->account_number ?? '-' }}</td>
                </tr>
                <tr>
                    <th>IFSC Code</th>
                    <td>{{ $deo->ifsc_code ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Area Operator ID</th>
                    <td>{{ $deo->area_operator_id ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- SYSTEM & ACTIVITY --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">System & Activity</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless mb-0">
                <tr>
                    <th width="30%">Email Verified</th>
                    <td>
                        @if($deo->email_verified_at)
                            <span class="badge bg-success">Verified</span>
                        @else
                            <span class="badge bg-danger">Not Verified</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Last Login</th>
                    <td>{{ $deo->last_login_at ?? 'Never' }}</td>
                </tr>
                <tr>
                    <th>Last Logout</th>
                    <td>{{ $deo->last_logout_at ?? 'Never' }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $deo->created_at }}</td>
                </tr>
            </table>
        </div>
    </div>

</div>
@endsection
