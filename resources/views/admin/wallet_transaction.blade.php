{{-- resources/views/admin/wallet-transactions/index.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Wallet Transactions
    $transactions = collect([
        (object) [
            'id' => 1,
            'txn_id' => '#TXN-001',
            'user' => 'John Doe',
            'type' => 'Earn',
            'type_badge' => 'bg-success',
            'points_amount' => '+50 Points',
            'date_time' => '2025-12-04 10:30 AM',
            'status' => 'Completed',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 2,
            'txn_id' => '#TXN-002',
            'user' => 'Jane Smith',
            'type' => 'Use',
            'type_badge' => 'bg-warning',
            'points_amount' => '-25 Points',
            'date_time' => '2025-12-04 11:15 AM',
            'status' => 'Completed',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 3,
            'txn_id' => '#TXN-003',
            'user' => 'Mike Johnson',
            'type' => 'Earn',
            'type_badge' => 'bg-success',
            'points_amount' => '+100 Points',
            'date_time' => '2025-12-04 02:45 PM',
            'status' => 'Pending',
            'status_badge' => 'bg-info',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Wallet Transactions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Gift Cards & Wallet</a></li>
                        <li class="breadcrumb-item active">Wallet Transactions</li>
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

    {{-- Wallet Transactions Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Point/Amount Transactions</h4>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" style="width: auto;">
                                <option>Filter by Type</option>
                                <option>Earn</option>
                                <option>Use</option>
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
                                            <input class="form-check-input" type="checkbox" id="checkAllTransactions" value="option">
                                            <label class="form-check-label" for="checkAllTransactions"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Transaction ID</th>
                                    <th class="border-0">User</th>
                                    <th class="border-0">Type</th>
                                    <th class="border-0">Points Amount</th>
                                    <th class="border-0">Date & Time</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="transaction{{ $transaction->id }}" value="option{{ $transaction->id }}">
                                                <label class="form-check-label" for="transaction{{ $transaction->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $transaction->txn_id }}</td>
                                        <td>{{ $transaction->user }}</td>
                                        <td><span class="badge {{ $transaction->type_badge }}">{{ $transaction->type }}</span></td>
                                        <td>{{ $transaction->points_amount }}</td>
                                        <td>{{ $transaction->date_time }}</td>
                                        <td><span class="badge {{ $transaction->status_badge }}">{{ $transaction->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-soft-primary material-shadow-none">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            <a href="" class="btn btn-sm btn-soft-warning material-shadow-none">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="ri-wallet-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No transactions found.</p>
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

    {{-- Static View Transaction Modal --}}
    <div class="modal fade" id="viewTransactionModal" tabindex="-1" aria-labelledby="viewTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewTransactionModalLabel">View Transaction Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Transaction ID:</strong> #TXN-001</p>
                    <p><strong>User:</strong> John Doe</p>
                    <p><strong>Type:</strong> Earn</p>
                    <p><strong>Points Amount:</strong> +50 Points</p>
                    <p><strong>Date & Time:</strong> 2025-12-04 10:30 AM</p>
                    <p><strong>Status:</strong> Completed</p>
                    <p><strong>Description:</strong> Daily login reward</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Transaction Modal --}}
    <div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTransactionModalLabel">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="2">Daily login reward</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection