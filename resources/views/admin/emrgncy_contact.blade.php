{{-- resources/views/admin/emergency-contacts/index.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Emergency Contacts
    $contacts = collect([
        (object) [
            'id' => 1,
            'type' => 'Police',
            'type_icon' => 'ri-police-car-line',
            'type_bg' => 'bg-danger-subtle text-danger',
            'name' => 'Local Police Station',
            'number' => '100',
            'address' => 'Main Road, Village Center, Panchayath Area',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 2,
            'type' => 'Hospital',
            'type_icon' => 'ri-hospital-line',
            'type_bg' => 'bg-primary-subtle text-primary',
            'name' => 'General Hospital',
            'number' => '108',
            'address' => 'Hospital Lane, Near Market, Panchayath Area',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 3,
            'type' => 'Fire',
            'type_icon' => 'ri-fire-line',
            'type_bg' => 'bg-warning-subtle text-warning',
            'name' => 'Fire Department Station',
            'number' => '101',
            'address' => 'Station Road, Industrial Zone, Panchayath Area',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 4,
            'type' => 'Ambulance',
            'type_icon' => 'ri-ambulance-line',
            'type_bg' => 'bg-info-subtle text-info',
            'name' => 'Emergency Ambulance Service',
            'number' => '102',
            'address' => 'Linked to General Hospital, Panchayath Area',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 5,
            'type' => 'Other',
            'type_icon' => 'ri-customer-service-line',
            'type_bg' => 'bg-secondary-subtle text-secondary',
            'name' => 'Panchayath Helpline',
            'number' => '+91 40 1234 5678',
            'address' => 'Panchayath Office, Village Square, Panchayath Area',
            'status' => 'Pending',
            'status_badge' => 'bg-warning-subtle text-warning',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Emergency Contacts</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Information & Notices</a></li>
                        <li class="breadcrumb-item active">Emergency Contacts</li>
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

    {{-- Controls --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <input type="text" class="form-control" placeholder="Search contacts..." id="contactSearch">
                    <span class="mdi mdi-magnify position-absolute end-0 top-50 translate-middle-y pe-3 text-muted"></span>
                </div>
                <select class="form-select w-auto" id="typeFilter">
                    <option>All Types</option>
                    <option>Police</option>
                    <option>Hospital</option>
                    <option>Fire</option>
                    <option>Other</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addContactModal">
                <i class="ri-add-line me-1"></i> Add New Contact
            </button>
            <a href="#" class="btn btn-outline-secondary">
                <i class="ri-download-line me-1"></i> Export List
            </a>
        </div>
    </div>

    {{-- Emergency Contacts Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Emergency Contact Directory</h4>
                    <div class="flex-shrink-0">
                        <small class="text-muted">Total Contacts: <span id="totalContacts">{{ $contacts->count() }}</span></small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0" id="contactsTable">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Service Type</th>
                                    <th scope="col">Name/Department</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Address/Location</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <span class="avatar-xs">
                                                        <span class="avatar-title {{ $contact->type_bg }} rounded-circle fs-3">
                                                            <i class="{{ $contact->type_icon }}"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold">{{ $contact->type }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $contact->name }}</td>
                                        <td><a href="tel:{{ $contact->number }}" class="text-decoration-none">{{ $contact->number }}</a></td>
                                        <td>{{ $contact->address }}</td>
                                        <td><span class="badge {{ $contact->status_badge }}">{{ $contact->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-outline-info me-1">
                                                View
                                            </a>
                                            <a href="" class="btn btn-sm btn-outline-warning me-1">
                                                Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this contact?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="ri-contacts-book-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No emergency contacts found.</p>
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

    {{-- Add New Contact Modal --}}
    <div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContactModalLabel">Add New Emergency Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="addContactForm">
                        @csrf
                        <div class="mb-3">
                            <label for="contactType" class="form-label">Service Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="contactType" name="type" required>
                                <option value="">Select Type</option>
                                <option value="police" {{ old('type') == 'police' ? 'selected' : '' }}>Police</option>
                                <option value="hospital" {{ old('type') == 'hospital' ? 'selected' : '' }}>Hospital</option>
                                <option value="fire" {{ old('type') == 'fire' ? 'selected' : '' }}>Fire</option>
                                <option value="ambulance" {{ old('type') == 'ambulance' ? 'selected' : '' }}>Ambulance</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contactName" class="form-label">Name/Department</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="contactName" name="name" placeholder="Enter name or department" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control @error('number') is-invalid @enderror" id="contactNumber" name="number" placeholder="Enter phone number" value="{{ old('number') }}" required>
                            @error('number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contactAddress" class="form-label">Address/Location</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="contactAddress" name="address" rows="2" placeholder="Enter address or location" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contactStatus" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="contactStatus" name="status">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addContactForm" class="btn btn-primary">Save Contact</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static View Contact Modal --}}
    <div class="modal fade" id="viewContactModal" tabindex="-1" aria-labelledby="viewContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewContactModalLabel">View Emergency Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="viewContactDetails">
                        {{-- Dynamic content loaded via JS or route --}}
                        <p><strong>Type:</strong> Police</p>
                        <p><strong>Name:</strong> Local Police Station</p>
                        <p><strong>Number:</strong> <a href="tel:100">100</a></p>
                        <p><strong>Address:</strong> Main Road, Village Center, Panchayath Area</p>
                        <p><strong>Status:</strong> Active</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Contact Modal --}}
    <div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContactModalLabel">Edit Emergency Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="editContactForm">
                        {{-- Dynamic content loaded via JS or route --}}
                        <div class="mb-3">
                            <label for="editType" class="form-label">Service Type</label>
                            <select class="form-select" id="editType">
                                <option>Police</option>
                                <option>Hospital</option>
                                <option>Fire</option>
                                <option>Ambulance</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name/Department</label>
                            <input type="text" class="form-control" id="editName" value="Local Police Station">
                        </div>
                        <div class="mb-3">
                            <label for="editNumber" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="editNumber" value="100">
                        </div>
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Address/Location</label>
                            <textarea class="form-control" id="editAddress" rows="2">Main Road, Village Center, Panchayath Area</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-select" id="editStatus">
                                <option>Active</option>
                                <option>Pending</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update Contact</button>
                </div>
            </div>
        </div>
    </div>
@endsection