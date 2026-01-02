{{-- resources/views/admin/staff/permissions.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Roles
    $roles = collect([
        (object) [
            'id' => 1,
            'name' => 'Super Admin',
            'description' => 'Complete administrative control over the entire platform.',
            'permissions_overview' => 'All Modules',
            'assigned_users' => 5,
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'type' => 'full',
        ],
        (object) [
            'id' => 2,
            'name' => 'Moderator',
            'description' => 'Handles user moderation and content approval.',
            'permissions_overview' => 'Users, Listings',
            'assigned_users' => 12,
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'type' => 'partial',
        ],
        (object) [
            'id' => 3,
            'name' => 'Support Staff',
            'description' => 'Access to support tools and basic reporting.',
            'permissions_overview' => 'Support, Reports',
            'assigned_users' => 8,
            'status' => 'Pending',
            'status_badge' => 'bg-warning-subtle text-warning',
            'type' => 'limited',
        ],
        (object) [
            'id' => 4,
            'name' => 'Analyst',
            'description' => 'Read-only access to dashboards and reports.',
            'permissions_overview' => 'Analytics, Read-Only',
            'assigned_users' => 3,
            'status' => 'Inactive',
            'status_badge' => 'bg-danger-subtle text-danger',
            'type' => 'read-only',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Roles & Permissions</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Staff Management</a></li>
                        <li class="breadcrumb-item active">Roles & Permissions</li>
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

    {{-- Roles Management --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Roles & Permissions</h4>
                    <div class="flex-shrink-0">
                        <a href="#" class="btn btn-soft-primary btn-sm material-shadow-none" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                            <i class="ri-add-line align-middle"></i> Create New Role
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Permissions Overview</th>
                                    <th scope="col">Assigned Users</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>
                                            <h6 class="fs-14 mb-0">{{ $role->name }}</h6>
                                            <span class="text-muted fs-12">{{ $role->description }}</span>
                                        </td>
                                        <td>{{ $role->description }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                <span class="badge bg-success-subtle text-success">{{ $role->permissions_overview }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $role->assigned_users }}</td>
                                        <td><span class="badge {{ $role->status_badge }}">{{ $role->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-info">View</a>
                                            <a href="" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this role?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="ri-user-settings-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No roles found.</p>
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

    {{-- Create Role Modal --}}
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-labelledby="createRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel">Create New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="roleName" name="name" placeholder="Enter role name">
                        </div>
                        <div class="mb-3">
                            <label for="roleDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="roleDescription" name="description" rows="3" placeholder="Enter description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Default Permissions</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permUsers" name="permissions[users]">
                                        <label class="form-check-label" for="permUsers">Users Management</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permListings" name="permissions[listings]">
                                        <label class="form-check-label" for="permListings">Listings</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permAds" name="permissions[ads]">
                                        <label class="form-check-label" for="permAds">Advertisements</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permReports" name="permissions[reports]">
                                        <label class="form-check-label" for="permReports">Reports</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="createRoleForm" class="btn btn-primary">Create Role</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static View Permissions Modal (Example for Super Admin) --}}
    <div class="modal fade" id="viewPermissionsModal" tabindex="-1" aria-labelledby="viewPermissionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPermissionsModalLabel">View Permissions for Super Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Description:</strong> Full access to all modules.</p>
                    <h6>Permissions:</h6>
                    <ul class="list-unstyled">
                        <li class="text-success"><i class="ri-check-line me-2"></i>Users Management</li>
                        <li class="text-success"><i class="ri-check-line me-2"></i>Listings</li>
                        <li class="text-success"><i class="ri-check-line me-2"></i>Advertisements</li>
                        <li class="text-success"><i class="ri-check-line me-2"></i>Reports</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Permissions Modal (Example for Super Admin) --}}
    <div class="modal fade" id="editPermissionsModal" tabindex="-1" aria-labelledby="editPermissionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPermissionsModalLabel">Edit Permissions for Super Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <h6>Users Management</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editPermUsersView" checked>
                                    <label class="form-check-label" for="editPermUsersView">View Users</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editPermUsersEdit" checked>
                                    <label class="form-check-label" for="editPermUsersEdit">Edit Users</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <h6>Listings</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editPermListingsView" checked>
                                    <label class="form-check-label" for="editPermListingsView">View Listings</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editPermListingsApprove" checked>
                                    <label class="form-check-label" for="editPermListingsApprove">Approve/Reject</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <h6>Advertisements</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editPermAdsManage" checked>
                                    <label class="form-check-label" for="editPermAdsManage">Manage Ads</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <h6>Reports</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editPermReportsView" checked>
                                    <label class="form-check-label" for="editPermReportsView">View Reports</label>
                                </div>
                            </div>
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