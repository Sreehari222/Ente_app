@extends('layouts.admin')

@php
    // Dummy data for Redemption Requests
    $requests = collect([
        (object) [
            'id' => 1,
            'req_id' => '#REQ-001',
            'user' => 'John Doe',
            'points' => '500 Points',
            'requested_for' => '$5 Voucher',
            'date' => '2025-12-04',
            'status' => 'Pending',
            'status_badge' => 'bg-warning',
        ],
        (object) [
            'id' => 2,
            'req_id' => '#REQ-002',
            'user' => 'Jane Smith',
            'points' => '1000 Points',
            'requested_for' => 'Free Product',
            'date' => '2025-12-04',
            'status' => 'Pending',
            'status_badge' => 'bg-warning',
        ],
        (object) [
            'id' => 3,
            'req_id' => '#REQ-003',
            'user' => 'Mike Johnson',
            'points' => '250 Points',
            'requested_for' => '$2 Discount',
            'date' => '2025-12-03',
            'status' => 'Approved',
            'status_badge' => 'bg-success',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Redemption Requests</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Gift Cards & Wallet</a></li>
                        <li class="breadcrumb-item active">Redemption Requests</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Redemption Requests Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Pending Redemption Requests</h4>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" style="width: auto;">
                                <option>Filter by Status</option>
                                <option>Pending</option>
                                <option>Approved</option>
                                <option>Rejected</option>
                            </select>
                            <a href="#" class="btn btn-primary btn-sm material-shadow-none">
                                <i class="ri-download-line align-middle"></i> Export
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAllRequests" value="option">
                                            <label class="form-check-label" for="checkAllRequests"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Request ID</th>
                                    <th class="border-0">User</th>
                                    <th class="border-0">Points to Redeem</th>
                                    <th class="border-0">Requested For</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requests as $request)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="request{{ $request->id }}" value="option{{ $request->id }}">
                                                <label class="form-check-label" for="request{{ $request->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $request->req_id }}</td>
                                        <td>{{ $request->user }}</td>
                                        <td>{{ $request->points }}</td>
                                        <td>{{ $request->requested_for }}</td>
                                        <td>{{ $request->date }}</td>
                                        <td><span class="badge {{ $request->status_badge }}">{{ $request->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-soft-primary material-shadow-none">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            @if($request->status == 'Pending')
                                                <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Approve this request?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success material-shadow-none">
                                                        <i class="ri-check-line"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Reject this request?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger material-shadow-none">
                                                        <i class="ri-close-line"></i> Reject
                                                    </button>
                                                </form>
                                            @else
                                                <a href="#" class="btn btn-sm btn-info material-shadow-none">
                                                    <i class="ri-eye-line"></i> Details
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="ri-exchange-dollar-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No redemption requests found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        <ul class="pagination pagination-separated pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a href="#" class="page-link">←</a>
                            </li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item active"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">→</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Static View Request Modal --}}
    <div class="modal fade" id="viewRequestModal" tabindex="-1" aria-labelledby="viewRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRequestModalLabel">View Redemption Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Request ID:</strong> #REQ-001</p>
                    <p><strong>User:</strong> John Doe</p>
                    <p><strong>Points to Redeem:</strong> 500 Points</p>
                    <p><strong>Requested For:</strong> $5 Voucher</p>
                    <p><strong>Date:</strong> 2025-12-04</p>
                    <p><strong>Status:</strong> Pending</p>
                    <p><strong>Notes:</strong> User has sufficient points in wallet.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Approve Request Modal --}}
    <div class="modal fade" id="approveRequestModal" tabindex="-1" aria-labelledby="approveRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveRequestModalLabel">Approve Redemption Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to approve this redemption request? Points will be deducted and the reward issued.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Approve</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Reject Request Modal --}}
    <div class="modal fade" id="rejectRequestModal" tabindex="-1" aria-labelledby="rejectRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectRequestModalLabel">Reject Redemption Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reject this request? Provide a reason:</p>
                    <textarea class="form-control" rows="3" placeholder="Enter rejection reason..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Reject</button>
                </div>
            </div>
        </div>
    </div>
@endsection