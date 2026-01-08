@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">DEO Details</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <td>{{ $deo->id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ $deo->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $deo->email }}</td>
                </tr>

                <tr>
                    <th>Email Verified At</th>
                    <td>
                        {{ $deo->email_verified_at ?? 'Not Verified' }}
                    </td>
                </tr>

                <tr>
                    <th>Role</th>
                    <td>
                        <span class="badge bg-info text-uppercase">
                            {{ $deo->role }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Area Operator ID</th>
                    <td>{{ $deo->area_operator_id ?? '-' }}</td>
                </tr>

            </table>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('admin.deos') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </div>

</div>
@endsection
