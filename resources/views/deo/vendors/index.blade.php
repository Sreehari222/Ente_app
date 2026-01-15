@extends('layouts.deo')

@section('title', 'All Vendors')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold">All Vendors</h4>
            <p class="text-muted">Vendors added by your salesmen</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Vendor List</h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Shop Name</th>
                        <th>Salesman</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vendors as $index => $vendor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $vendor->shop_name }}</td>
                            <td>{{ $vendor->salesman->name ?? $vendor->created_by }}</td>
                            <td>
                                @if($vendor->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($vendor->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $vendor->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No vendors found under your salesmen
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
