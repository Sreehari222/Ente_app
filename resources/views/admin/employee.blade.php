{{-- resources/views/admin/staff/employees.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Employees
    $employees = collect([
        (object) [
            'id' => 1,
            'name' => 'John Doe',
            'avatar' => asset('assets/images/users/avatar-1.jpg'),
            'role' => 'Super Admin',
            'role_badge' => 'bg-primary-subtle text-primary',
            'email' => 'johndoe@company.com',
            'department' => 'IT',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'joined_date' => '15 Oct, 2025',
        ],
        (object) [
            'id' => 2,
            'name' => 'Jane Smith',
            'avatar' => asset('assets/images/users/avatar-2.jpg'),
            'role' => 'Moderator',
            'role_badge' => 'bg-info-subtle text-info',
            'email' => 'janesmith@company.com',
            'department' => 'HR',
            'status' => 'Pending',
            'status_badge' => 'bg-warning-subtle text-warning',
            'joined_date' => '20 Nov, 2025',
        ],
        (object) [
            'id' => 3,
            'name' => 'Mike Johnson',
            'avatar' => asset('assets/images/users/avatar-3.jpg'),
            'role' => 'Support Staff',
            'role_badge' => 'bg-success-subtle text-success',
            'email' => 'mikejohnson@company.com',
            'department' => 'Customer Service',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'joined_date' => '10 Sep, 2025',
        ],
        (object) [
            'id' => 4,
            'name' => 'Sarah Wilson',
            'avatar' => asset('assets/images/users/avatar-4.jpg'),
            'role' => 'Analyst',
            'role_badge' => 'bg-secondary-subtle text-secondary',
            'email' => 'sarahwilson@company.com',
            'department' => 'Finance',
            'status' => 'Inactive',
            'status_badge' => 'bg-danger-subtle text-danger',
            'joined_date' => '05 Aug, 2025',
        ],
        // Add more dummy employees as needed
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Employees List</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Staff Management</a></li>
                        <li class="breadcrumb-item active">Employees</li>
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

    {{-- Employees List Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Admin Team Members</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-soft-primary btn-sm material-shadow-none" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                            <i class="ri-add-line align-middle"></i> Add New Employee
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Joined Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($employees as $employee)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ $employee->avatar }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="fs-14 mb-0">{{ $employee->name }}</h6>
                                                    <span class="text-muted fs-12">Admin</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $employee->email }}</td>
                                        <td><span class="badge {{ $employee->role_badge }}">{{ $employee->role }}</span></td>
                                        <td>{{ $employee->department }}</td>
                                        <td><span class="badge {{ $employee->status_badge }}">{{ $employee->status }}</span></td>
                                        <td>{{ $employee->joined_date }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">View</a>
                                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="#" method="POST" style="display: inline;" onsubmit="return confirm('Delete this employee?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="ri-team-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No employees found.</p>
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

    {{-- Add Employee Modal --}}
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="employeeName" name="name" placeholder="Enter full name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="employeeEmail" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="employeeEmail" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="employeeRole" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="employeeRole" name="role" required>
                                <option value="">Select Role</option>
                                <option value="super-admin" {{ old('role') == 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="moderator" {{ old('role') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                                <option value="support" {{ old('role') == 'support' ? 'selected' : '' }}>Support Staff</option>
                                <option value="analyst" {{ old('role') == 'analyst' ? 'selected' : '' }}>Analyst</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="employeeDepartment" class="form-label">Department</label>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" id="employeeDepartment" name="department" placeholder="Enter department" value="{{ old('department') }}" required>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addEmployeeForm" class="btn btn-primary">Add Employee</button>
                </div>
            </div>
        </div>
    </div>
@endsection