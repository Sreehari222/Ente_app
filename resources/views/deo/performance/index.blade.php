@extends('layouts.deo')

@section('title', 'Salesman Performance')

@section('content')
<div class="container-fluid">

    {{-- Page Title --}}
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold">Salesman Performance Dashboard</h4>
            <p class="text-muted">Track salesmen activity, productivity & approvals</p>
        </div>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Salesmen</h6>
                    <h3>{{ $salesmen->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Vendors</h6>
                    <h3>{{ $salesmen->sum('vendors_count') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Approved Vendors</h6>
                    <h3>{{ $salesmen->sum('approved_vendors_count') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6>Total Submissions</h6>
                    <h3>{{ $salesmen->sum('submissions_count') }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- PERFORMANCE TABLE --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Salesman Performance Details</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Salesman</th>
                        <th>Mobile</th>
                        <th>Vendors Added</th>
                        <th>Approved Vendors</th>
                        <th>Submissions</th>
                        <th>Efficiency</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($salesmen as $index => $salesman)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $salesman->name }}</strong><br>
                                <small>{{ $salesman->email }}</small>
                            </td>
                            <td>{{ $salesman->mobile ?? '-' }}</td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $salesman->vendors_count }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $salesman->approved_vendors_count }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $salesman->submissions_count }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $eff = $salesman->vendors_count > 0
                                        ? round(($salesman->approved_vendors_count / $salesman->vendors_count) * 100)
                                        : 0;
                                @endphp

                                <span class="badge bg-warning">
                                    {{ $eff }}%
                                </span>
                            </td>
                            <td>
                                <a href=""
                                   class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    @if($salesmen->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                No salesmen data found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
