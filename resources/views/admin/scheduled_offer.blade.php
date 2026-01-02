{{-- resources/views/admin/offers/scheduled.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Scheduled Offers
    $scheduledOffers = collect([
        (object) [
            'id' => 1,
            'title' => 'New Year Special',
            'description' => 'Exclusive deals for New Year celebrations',
            'discount' => '30%',
            'start_date' => '2025-12-10',
            'end_date' => '2026-01-10',
            'status' => 'Scheduled',
            'status_badge' => 'bg-info',
        ],
        (object) [
            'id' => 2,
            'title' => "Valentine's Day Bundle",
            'description' => 'Buy gifts and get extra discounts',
            'discount' => 'BOGO',
            'start_date' => '2026-02-01',
            'end_date' => '2026-02-14',
            'status' => 'Scheduled',
            'status_badge' => 'bg-info',
        ],
        (object) [
            'id' => 3,
            'title' => 'Spring Refresh Sale',
            'description' => 'Refresh your wardrobe with 25% off',
            'discount' => '25%',
            'start_date' => '2026-03-15',
            'end_date' => '2026-03-31',
            'status' => 'Scheduled',
            'status_badge' => 'bg-info',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Scheduled Offers</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Offers & Promotions</a></li>
                        <li class="breadcrumb-item active">Scheduled Offers</li>
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

    {{-- Scheduled Offers Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Scheduled Offers List</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-primary btn-sm material-shadow-none">
                            <i class="ri-add-line align-middle"></i> Create New Offer
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
                                            <input class="form-check-input" type="checkbox" id="checkAllScheduled" value="option">
                                            <label class="form-check-label" for="checkAllScheduled"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Offer Title</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Discount</th>
                                    <th class="border-0">Scheduled Start Date</th>
                                    <th class="border-0">End Date</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($scheduledOffers as $offer)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="scheduled{{ $offer->id }}" value="option{{ $offer->id }}">
                                                <label class="form-check-label" for="scheduled{{ $offer->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $offer->title }}</td>
                                        <td>{{ $offer->description }}</td>
                                        <td>{{ $offer->discount }}</td>
                                        <td>{{ $offer->start_date }}</td>
                                        <td>{{ $offer->end_date }}</td>
                                        <td><span class="badge {{ $offer->status_badge }}">{{ $offer->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-soft-primary material-shadow-none">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            <a href="" class="btn btn-sm btn-soft-warning material-shadow-none">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this scheduled offer?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger material-shadow-none">
                                                    <i class="ri-delete-bin-line"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="ri-time-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No scheduled offers found.</p>
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

    {{-- Static View Scheduled Offer Modal --}}
    <div class="modal fade" id="viewOfferModal" tabindex="-1" aria-labelledby="viewOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOfferModalLabel">View Scheduled Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('assets/images/offer-sample-2.jpg') }}" alt="Offer Preview" class="img-fluid mb-3">
                    <p><strong>Title:</strong> New Year Special</p>
                    <p><strong>Description:</strong> Exclusive deals for New Year celebrations</p>
                    <p><strong>Discount:</strong> 30%</p>
                    <p><strong>Scheduled Start Date:</strong> 2025-12-10</p>
                    <p><strong>End Date:</strong> 2026-01-10</p>
                    <p><strong>Status:</strong> Scheduled</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Scheduled Offer Modal --}}
    <div class="modal fade" id="editOfferModal" tabindex="-1" aria-labelledby="editOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOfferModalLabel">Edit Scheduled Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="offerTitle" class="form-label">Offer Title</label>
                            <input type="text" class="form-control" id="offerTitle" value="New Year Special">
                        </div>
                        <div class="mb-3">
                            <label for="offerDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="offerDescription" rows="3">Exclusive deals for New Year celebrations</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount</label>
                            <input type="text" class="form-control" id="discount" value="30%">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Scheduled Start Date</label>
                                    <input type="date" class="form-control" id="startDate" value="2025-12-10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="endDate" value="2026-01-10">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="scheduled">Scheduled</option>
                                <option value="active">Activate Now</option>
                                <option value="paused">Pause</option>
                                <option value="cancelled">Cancel</option>
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

    {{-- Static Delete Scheduled Offer Modal --}}
    <div class="modal fade" id="deleteOfferModal" tabindex="-1" aria-labelledby="deleteOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOfferModalLabel">Delete Scheduled Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this scheduled offer? It will not publish and cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection