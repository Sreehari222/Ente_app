@extends('layouts.admin')

@php
    $localities = collect([
        (object) [
            'id' => 1,
            'type' => 'Zone',
            'type_badge' => 'bg-primary-subtle text-primary',
            'name' => 'Central Panchayath Zone',
            'parent' => '-',
            'coordinates' => '17.3850° N, 78.4867° E',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 2,
            'type' => 'Area',
            'type_badge' => 'bg-info-subtle text-info',
            'name' => 'Village Square Area',
            'parent' => 'Central Panchayath Zone',
            'coordinates' => '17.3860° N, 78.4870° E',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 3,
            'type' => 'Location',
            'type_badge' => 'bg-warning-subtle text-warning',
            'name' => 'Community Hall',
            'parent' => 'Village Square Area',
            'coordinates' => '17.3855° N, 78.4865° E',
            'status' => 'Pending',
            'status_badge' => 'bg-warning-subtle text-warning',
        ],
        (object) [
            'id' => 4,
            'type' => 'Zone',
            'type_badge' => 'bg-primary-subtle text-primary',
            'name' => 'Eastern Locality Zone',
            'parent' => '-',
            'coordinates' => '17.3900° N, 78.5000° E',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 5,
            'type' => 'Area',
            'type_badge' => 'bg-info-subtle text-info',
            'name' => 'Market Area',
            'parent' => 'Eastern Locality Zone',
            'coordinates' => '17.3910° N, 78.5010° E',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 6,
            'type' => 'Location',
            'type_badge' => 'bg-warning-subtle text-warning',
            'name' => 'Local Market Stall',
            'parent' => 'Market Area',
            'coordinates' => '17.3905° N, 78.5005° E',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 7,
            'type' => 'Zone',
            'type_badge' => 'bg-primary-subtle text-primary',
            'name' => 'Western Residential Zone',
            'parent' => '-',
            'coordinates' => '17.3800° N, 78.4700° E',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
        ],
        (object) [
            'id' => 8,
            'type' => 'Area',
            'type_badge' => 'bg-info-subtle text-info',
            'name' => 'Residential Colony',
            'parent' => 'Western Residential Zone',
            'coordinates' => '17.3810° N, 78.4710° E',
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
                <h4 class="mb-sm-0">Panchayath / Locality Setup</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Profile & Settings</a></li>
                        <li class="breadcrumb-item active">Panchayath / Locality Setup</li>
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

    {{-- Setup Controls --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <input type="text" class="form-control" placeholder="Search zones/areas/locations..." id="setupSearch">
                    <span class="mdi mdi-magnify position-absolute end-0 top-50 translate-middle-y pe-3 text-muted"></span>
                </div>
                <select class="form-select w-auto" id="typeFilter">
                    <option>All Types</option>
                    <option>Zone</option>
                    <option>Area</option>
                    <option>Location</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addSetupModal">
                <i class="ri-add-line me-1"></i> Add New Zone/Area/Location
            </button>
            <a href="#" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#mapModal">
                <i class="ri-map-pin-line me-1"></i> View Map
            </a>
        </div>
    </div>

    {{-- Locality Setup Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Zones, Areas, and Locations</h4>
                    <div class="flex-shrink-0">
                        <small class="text-muted">Total Entries: <span id="totalEntries">{{ $localities->count() }}</span></small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Parent Zone/Area</th>
                                    <th scope="col">Coordinates</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($localities as $locality)
                                    <tr>
                                        <td><span class="badge {{ $locality->type_badge }}">{{ $locality->type }}</span></td>
                                        <td>{{ $locality->name }}</td>
                                        <td>{{ $locality->parent }}</td>
                                        <td>{{ $locality->coordinates }}</td>
                                        <td><span class="badge {{ $locality->status_badge }}">{{ $locality->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-outline-info me-1">
                                                View
                                            </a>
                                            <a href="" class="btn btn-sm btn-outline-warning me-1">
                                                Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this locality?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="ri-map-pin-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No localities found.</p>
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

    {{-- Map Placeholder --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Locality Map View</h4>
                </div>
                <div class="card-body">
                    <div id="mapPlaceholder" class="bg-light rounded p-4 text-center" style="height: 400px;">
                        <i class="ri-map-pin-line fs-1 text-muted mb-2 d-block"></i>
                        <p class="text-muted mb-0">Interactive Map Integration Placeholder</p>
                        <small class="text-muted">Integrate Google Maps API for visual zone/area management</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add New Setup Modal --}}
    <div class="modal fade" id="addSetupModal" tabindex="-1" aria-labelledby="addSetupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSetupModalLabel">Add New Zone/Area/Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="addSetupForm">
                        @csrf
                        <div class="mb-3">
                            <label for="setupType" class="form-label">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="setupType" name="type" required>
                                <option value="">Select Type</option>
                                <option value="Zone" {{ old('type') == 'Zone' ? 'selected' : '' }}>Zone</option>
                                <option value="Area" {{ old('type') == 'Area' ? 'selected' : '' }}>Area</option>
                                <option value="Location" {{ old('type') == 'Location' ? 'selected' : '' }}>Location</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setupName" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="setupName" name="name" placeholder="Enter name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="parentSetup" class="form-label">Parent Zone/Area</label>
                            <select class="form-select @error('parent') is-invalid @enderror" id="parentSetup" name="parent">
                                <option value="">None (Top Level)</option>
                                <option value="central-zone" {{ old('parent') == 'central-zone' ? 'selected' : '' }}>Central Panchayath Zone</option>
                                <option value="eastern-zone" {{ old('parent') == 'eastern-zone' ? 'selected' : '' }}>Eastern Locality Zone</option>
                                <option value="western-zone" {{ old('parent') == 'western-zone' ? 'selected' : '' }}>Western Residential Zone</option>
                            </select>
                            @error('parent')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" placeholder="e.g., 17.3850" value="{{ old('latitude') }}">
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" placeholder="e.g., 78.4867" value="{{ old('longitude') }}">
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setupStatus" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="setupStatus" name="status">
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
                    <button type="submit" form="addSetupForm" class="btn btn-primary">Save Setup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static View Setup Modal --}}
    <div class="modal fade" id="viewSetupModal" tabindex="-1" aria-labelledby="viewSetupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewSetupModalLabel">View Setup Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="viewSetupDetails">
                        {{-- Dynamic content loaded via JS or route --}}
                        <p><strong>Type:</strong> Zone</p>
                        <p><strong>Name:</strong> Central Panchayath Zone</p>
                        <p><strong>Parent:</strong> -</p>
                        <p><strong>Coordinates:</strong> 17.3850° N, 78.4867° E</p>
                        <p><strong>Status:</strong> Active</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Setup Modal --}}
    <div class="modal fade" id="editSetupModal" tabindex="-1" aria-labelledby="editSetupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSetupModalLabel">Edit Setup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="editSetupForm">
                        {{-- Dynamic content loaded via JS or route --}}
                        <div class="mb-3">
                            <label for="editType" class="form-label">Type</label>
                            <select class="form-select" id="editType">
                                <option>Zone</option>
                                <option>Area</option>
                                <option>Location</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" value="Central Panchayath Zone">
                        </div>
                        <div class="mb-3">
                            <label for="editParent" class="form-label">Parent Zone/Area</label>
                            <select class="form-select" id="editParent">
                                <option value="">None (Top Level)</option>
                                <option value="central-zone">Central Panchayath Zone</option>
                                <option value="eastern-zone">Eastern Locality Zone</option>
                                <option value="western-zone">Western Residential Zone</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editLatitude" class="form-label">Latitude</label>
                            <input type="number" step="any" class="form-control" id="editLatitude" value="17.3850">
                        </div>
                        <div class="mb-3">
                            <label for="editLongitude" class="form-label">Longitude</label>
                            <input type="number" step="any" class="form-control" id="editLongitude" value="78.4867">
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-select" id="editStatus">
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Update Setup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Map Modal --}}
    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Locality Map View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="interactiveMap" class="bg-light rounded p-4 text-center" style="height: 500px;">
                        <i class="ri-map-pin-line fs-1 text-muted mb-2 d-block"></i>
                        <p class="text-muted mb-0">Google Maps API Integration Placeholder</p>
                        <small class="text-muted">Embed interactive map for zone/area visualization</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection