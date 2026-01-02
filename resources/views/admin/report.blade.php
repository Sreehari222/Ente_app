@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Reports</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Pages</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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

    {{-- Reports Controls --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <input type="text" class="form-control" placeholder="Search reports..." id="reportSearch">
                    <span class="mdi mdi-magnify position-absolute end-0 top-50 translate-middle-y pe-3 text-muted"></span>
                </div>
                <select class="form-select w-auto" id="reportFilter">
                    <option>All Reports</option>
                    <option>User Reports</option>
                    <option>Listing Reports</option>
                    <option>Ads Performance</option>
                    <option>Offers Usage</option>
                    <option>Reward System Usage</option>
                    <option>Wallet Transactions</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#dateFilterModal">
                <i class="ri-calendar-line me-1"></i> Filter by Date
            </button>
            <a href="" class="btn btn-primary">
                <i class="ri-download-line me-1"></i> Generate Custom Report
            </a>
        </div>
    </div>

    {{-- Reports Grid --}}
    <div class="row">
        {{-- User Reports --}}
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-2">
                                <i class="ri-user-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">User Reports</h5>
                            <p class="text-muted mb-0">Detailed user activity, registration trends, and engagement metrics.</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="" class="btn btn-soft-primary btn-sm w-100">
                            <i class="ri-eye-line me-1"></i> View Report
                        </a>
                        <a href="" class="btn btn-outline-primary btn-sm w-100 mt-1">
                            <i class="ri-download-line me-1"></i> Download CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Listing Reports --}}
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-2">
                                <i class="ri-list-check-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Listing Reports</h5>
                            <p class="text-muted mb-0">Performance data on listings, approvals, and category-wise insights.</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="" class="btn btn-soft-success btn-sm w-100">
                            <i class="ri-eye-line me-1"></i> View Report
                        </a>
                        <a href="" class="btn btn-outline-success btn-sm w-100 mt-1">
                            <i class="ri-download-line me-1"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ads Performance --}}
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle text-info rounded-circle fs-2">
                                <i class="ri-advertisement-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Ads Performance</h5>
                            <p class="text-muted mb-0">Analytics on ad impressions, clicks, and conversion rates.</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="" class="btn btn-soft-info btn-sm w-100">
                            <i class="ri-eye-line me-1"></i> View Report
                        </a>
                        <a href="" class="btn btn-outline-info btn-sm w-100 mt-1">
                            <i class="ri-download-line me-1"></i> Download Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Offers Usage --}}
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-2">
                                <i class="ri-coupon-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Offers Usage</h5>
                            <p class="text-muted mb-0">Redemption rates, popular offers, and usage trends.</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="" class="btn btn-soft-warning btn-sm w-100">
                            <i class="ri-eye-line me-1"></i> View Report
                        </a>
                        <a href="" class="btn btn-outline-warning btn-sm w-100 mt-1">
                            <i class="ri-download-line me-1"></i> Download CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reward System Usage --}}
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-2">
                                <i class="ri-trophy-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Reward System Usage</h5>
                            <p class="text-muted mb-0">Engagement in challenges, spins, and reward redemptions.</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="" class="btn btn-soft-danger btn-sm w-100">
                            <i class="ri-eye-line me-1"></i> View Report
                        </a>
                        <a href="" class="btn btn-outline-danger btn-sm w-100 mt-1">
                            <i class="ri-download-line me-1"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Wallet Transactions --}}
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-secondary-subtle text-secondary rounded-circle fs-2">
                                <i class="ri-wallet-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="card-title mb-1">Wallet Transactions</h5>
                            <p class="text-muted mb-0">Transaction history, balances, and financial summaries.</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top">
                        <a href="" class="btn btn-soft-secondary btn-sm w-100">
                            <i class="ri-eye-line me-1"></i> View Report
                        </a>
                        <a href="" class="btn btn-outline-secondary btn-sm w-100 mt-1">
                            <i class="ri-download-line me-1"></i> Download Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Date Filter Modal (Static) --}}
    <div class="modal fade" id="dateFilterModal" tabindex="-1" aria-labelledby="dateFilterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateFilterModalLabel">Filter by Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="startDate">
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="endDate">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>

    {{-- View Report Modal --}}
    <div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="viewReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewReportModalLabel">View Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="reportContent">
                        {{-- Dynamic content will be loaded here based on report type --}}
                        <p class="text-muted">Select a report to view detailed data and charts.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="downloadFromModal">
                        <i class="ri-download-line me-1"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection