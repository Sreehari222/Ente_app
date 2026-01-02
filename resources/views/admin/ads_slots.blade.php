{{-- resources/views/admin/advertisements/ad-slots.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Ad Slots
    $slots = collect([
        (object) [
            'id' => 1,
            'name' => 'Home Banner',
            'app_location' => 'Top of Home Screen',
            'dimensions' => '320x50',
            'ad_type' => 'Banner',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 2,
            'name' => 'Interstitial Feed',
            'app_location' => 'Between Listings',
            'dimensions' => 'Full Screen',
            'ad_type' => 'Interstitial',
            'status' => 'Paused',
            'status_badge' => 'bg-warning',
        ],
        (object) [
            'id' => 3,
            'name' => 'Native Sidebar',
            'app_location' => 'Profile Sidebar',
            'dimensions' => '300x250',
            'ad_type' => 'Native',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Advertisements Slots Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Advertisements</a></li>
                        <li class="breadcrumb-item active">Ad Slots Management</li>
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

    {{-- Ad Slots Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Ad Slots</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-primary btn-sm material-shadow-none">
                            <i class="ri-add-line align-middle"></i> Create New Slot
                        </a>
                        <a href="" class="btn btn-soft-secondary btn-sm material-shadow-none ms-1">
                            <i class="ri-arrow-left-line align-middle"></i> Back to All Ads
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAllSlots" value="option">
                                            <label class="form-check-label" for="checkAllSlots"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Slot Name</th>
                                    <th class="border-0">App Location</th>
                                    <th class="border-0">Dimensions</th>
                                    <th class="border-0">Ad Type</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($slots as $slot)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="slot{{ $slot->id }}" value="option{{ $slot->id }}">
                                                <label class="form-check-label" for="slot{{ $slot->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $slot->name }}</td>
                                        <td>{{ $slot->app_location }}</td>
                                        <td>{{ $slot->dimensions }}</td>
                                        <td>{{ $slot->ad_type }}</td>
                                        <td><span class="badge {{ $slot->status_badge }}">{{ $slot->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-soft-primary material-shadow-none">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this slot?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger material-shadow-none">
                                                    <i class="ri-delete-bin-line"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="ri-layout-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No ad slots found.</p>
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

    {{-- Static Edit Slot Modal --}}
    <div class="modal fade" id="editSlotModal" tabindex="-1" aria-labelledby="editSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSlotModalLabel">Edit Ad Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="slotName" class="form-label">Slot Name</label>
                            <input type="text" class="form-control" id="slotName" value="Home Banner">
                        </div>
                        <div class="mb-3">
                            <label for="appLocation" class="form-label">App Location</label>
                            <input type="text" class="form-control" id="appLocation" value="Top of Home Screen">
                        </div>
                        <div class="mb-3">
                            <label for="dimensions" class="form-label">Dimensions</label>
                            <input type="text" class="form-control" id="dimensions" value="320x50">
                        </div>
                        <div class="mb-3">
                            <label for="adType" class="form-label">Ad Type</label>
                            <select class="form-select" id="adType">
                                <option value="banner">Banner</option>
                                <option value="interstitial">Interstitial</option>
                                <option value="native">Native</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="active">Active</option>
                                <option value="paused">Paused</option>
                            </select>
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

    {{-- Static Delete Slot Modal --}}
    <div class="modal fade" id="deleteSlotModal" tabindex="-1" aria-labelledby="deleteSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSlotModalLabel">Delete Ad Slot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this ad slot? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection