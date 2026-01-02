{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Overview</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- Overall App Summary Cards - Row 1 --}}
    <div class="row">
        {{-- Total Users --}}
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Users</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="12,456">0</span>
                            </h4>
                            <a href="" class="text-decoration-underline">View All Users</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-user text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Service Providers --}}
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Service Providers</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="2,345">0</span>
                            </h4>
                            <span class="badge bg-success-subtle text-success mb-0">
                                <i class="ri-arrow-up-line align-middle"></i> 15.3%
                            </span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                <i class="ri-handshake-line text-success"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Shop Owners --}}
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Shop Owners</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="1,890">0</span>
                            </h4>
                            <a href="" class="text-decoration-underline">View All Shops</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                <i class="bx bx-store text-info"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Total Listings --}}
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Listings</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="5,678">0</span>
                            </h4>
                            <span class="badge bg-success-subtle text-success mb-0">
                                <i class="ri-arrow-up-line align-middle"></i> 12.5% Growth
                            </span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-secondary-subtle rounded fs-3">
                                <i class="bx bx-list-ul text-secondary"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Overall App Summary Cards - Row 2 --}}
    <div class="row">
        {{-- Pending Approvals --}}
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pending Approvals</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="87">0</span>
                            </h4>
                            <a href="" class="text-decoration-underline text-warning">Review Now</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                <i class="bx bx-time-five text-warning"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Active Ads --}}
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Active Ads</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="156">0</span>
                            </h4>
                            <a href="" class="text-decoration-underline">View Ads</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-danger-subtle rounded fs-3">
                                <i class="ri-advertisement-line text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Active Offers --}}
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Active Offers</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="342">0</span>
                            </h4>
                            <a href="" class="text-decoration-underline">Manage Offers</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                <i class="bx bx-purchase-tag text-primary"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Rewards Overview --}}
        <div class="col-xl-3 col-md-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Rewards Overview</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                <span class="counter-value" data-target="1,234">0</span>
                            </h4>
                            <span class="badge bg-info-subtle text-info mb-0">
                                <i class="ri-arrow-up-line align-middle"></i> 22.7% Engagement
                            </span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                <i class="ri-gift-line text-info"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Recent Activity & Quick Actions --}}
    <div class="row">
        {{-- Recent Service Provider Applications --}}
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Recent Service Provider Applications</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-soft-primary btn-sm material-shadow-none">
                            <i class="ri-file-list-3-line align-middle"></i> View All
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Provider Name</th>
                                    <th scope="col">Service Type</th>
                                    <th scope="col">Applied Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1">Tech Solutions Ltd</div>
                                        </div>
                                    </td>
                                    <td>Electronics</td>
                                    <td>19 Nov, 2025</td>
                                    <td><span class="badge bg-warning-subtle text-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-success">Approve</button>
                                        <button class="btn btn-sm btn-danger">Reject</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1">Fashion Hub</div>
                                        </div>
                                    </td>
                                    <td>Clothing</td>
                                    <td>18 Nov, 2025</td>
                                    <td><span class="badge bg-success-subtle text-success">Approved</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1">Home Decor Plus</div>
                                        </div>
                                    </td>
                                    <td>Home & Garden</td>
                                    <td>17 Nov, 2025</td>
                                    <td><span class="badge bg-warning-subtle text-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-success">Approve</button>
                                        <button class="btn btn-sm btn-danger">Reject</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1">Sports Arena</div>
                                        </div>
                                    </td>
                                    <td>Sports & Fitness</td>
                                    <td>16 Nov, 2025</td>
                                    <td><span class="badge bg-success-subtle text-success">Approved</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Quick Actions --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quick Actions</h4>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-label">
                            <i class="ri-user-add-line label-icon align-middle fs-16 me-2"></i> Add New Provider
                        </button>
                        <button class="btn btn-info btn-label">
                            <i class="ri-file-list-3-line label-icon align-middle fs-16 me-2"></i> Review Approvals
                        </button>
                        <button class="btn btn-success btn-label">
                            <i class="ri-list-check label-icon align-middle fs-16 me-2"></i> Manage Listings
                        </button>
                        <button class="btn btn-warning btn-label">
                            <i class="ri-advertisement-line label-icon align-middle fs-16 me-2"></i> Ad Management
                        </button>
                        <button class="btn btn-secondary btn-label">
                            <i class="ri-file-chart-line label-icon align-middle fs-16 me-2"></i> Generate Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
