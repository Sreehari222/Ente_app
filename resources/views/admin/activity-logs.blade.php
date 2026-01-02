{{-- resources/views/admin/staff/activity-logs.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Activity Logs
    $logs = collect([
        (object) [
            'id' => 1,
            'employee_name' => 'John Doe',
            'employee_avatar' => asset('assets/images/users/avatar-1.jpg'),
            'employee_role' => 'Super Admin',
            'action' => 'Login Successful',
            'module' => 'Authentication',
            'description' => 'User accessed the admin panel.',
            'timestamp' => '2025-12-02 14:30:22',
            'ip_address' => '192.168.1.100',
            'status' => 'Success',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 2,
            'employee_name' => 'Jane Smith',
            'employee_avatar' => asset('assets/images/users/avatar-2.jpg'),
            'employee_role' => 'Moderator',
            'action' => 'Edit User Profile',
            'module' => 'Users Management',
            'description' => 'Updated user details for ID: 456.',
            'timestamp' => '2025-12-02 13:45:10',
            'ip_address' => '10.0.0.50',
            'status' => 'Warning',
            'status_badge' => 'bg-warning-subtle text-warning',
        ],
        (object) [
            'id' => 3,
            'employee_name' => 'Mike Johnson',
            'employee_avatar' => asset('assets/images/users/avatar-3.jpg'),
            'employee_role' => 'Support Staff',
            'action' => 'Approve Listing',
            'module' => 'Listings',
            'description' => 'Approved listing with ID: 789.',
            'timestamp' => '2025-12-01 16:20:05',
            'ip_address' => '172.16.0.20',
            'status' => 'Success',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 4,
            'employee_name' => 'Sarah Wilson',
            'employee_avatar' => asset('assets/images/users/avatar-4.jpg'),
            'employee_role' => 'Analyst',
            'action' => 'Generate Report',
            'module' => 'Reports',
            'description' => 'Exported user analytics report.',
            'timestamp' => '2025-12-01 11:15:33',
            'ip_address' => '203.0.113.10',
            'status' => 'Success',
            'status_badge' => 'bg-success-subtle text-success',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Activity Logs</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Staff Management</a></li>
                        <li class="breadcrumb-item active">Activity Logs</li>
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

    {{-- Activity Logs Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Track Employee Actions</h4>
                    <div class="flex-shrink-0">
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm">
                                <option>All Employees</option>
                                <option>John Doe</option>
                                <option>Jane Smith</option>
                                <option>Mike Johnson</option>
                            </select>
                            <select class="form-select form-select-sm">
                                <option>All Actions</option>
                                <option>Login</option>
                                <option>Edit User</option>
                                <option>Approve Listing</option>
                            </select>
                            <a href="#" class="btn btn-soft-primary btn-sm material-shadow-none">
                                <i class="ri-download-line align-middle"></i> Export
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Employee</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Module</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Timestamp</th>
                                    <th scope="col">IP Address</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ $log->employee_avatar }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="fs-14 mb-0">{{ $log->employee_name }}</h6>
                                                    <span class="text-muted fs-12">{{ $log->employee_role }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $log->action }}</td>
                                        <td>{{ $log->module }}</td>
                                        <td>{{ $log->description }}</td>
                                        <td>{{ $log->timestamp }}</td>
                                        <td>{{ $log->ip_address }}</td>
                                        <td><span class="badge {{ $log->status_badge }}">{{ $log->status }}</span></td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#viewLogModal">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="ri-history-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No activity logs found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Static View Log Details Modal (Example for first log) --}}
    <div class="modal fade" id="viewLogModal" tabindex="-1" aria-labelledby="viewLogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewLogModalLabel">Log Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Employee:</strong> John Doe</p>
                    <p><strong>Action:</strong> Login Successful</p>
                    <p><strong>Module:</strong> Authentication</p>
                    <p><strong>Description:</strong> User accessed the admin panel.</p>
                    <p><strong>Timestamp:</strong> 2025-12-02 14:30:22</p>
                    <p><strong>IP Address:</strong> 192.168.1.100</p>
                    <p><strong>Status:</strong> <span class="badge bg-success-subtle text-success">Success</span></p>
                    <p><strong>Additional Details:</strong> Session ID: abc123, Device: Chrome on Windows</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection