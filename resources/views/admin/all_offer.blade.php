{{-- resources/views/admin/offers/all-offers.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Offers
    $offers = collect([
        (object) [
            'id' => 1,
            'title' => 'Winter Clearance Sale',
            'description' => 'Up to 50% off on all winter apparel',
            'discount' => '50%',
            'start_date' => '2025-12-01',
            'end_date' => '2025-12-31',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 2,
            'title' => 'Buy One Get One Free',
            'description' => 'Free second item on select electronics',
            'discount' => 'BOGO',
            'start_date' => '2025-11-15',
            'end_date' => '2025-12-15',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 3,
            'title' => 'Flash Sale: 20% Off',
            'description' => 'Limited time discount on groceries',
            'discount' => '20%',
            'start_date' => '2025-12-04',
            'end_date' => '2025-12-06',
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
                <h4 class="mb-sm-0">All Offers</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Offers & Promotions</a></li>
                        <li class="breadcrumb-item active">All Offers</li>
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

    {{-- All Offers Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Active Offers List</h4>
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
                                            <input class="form-check-input" type="checkbox" id="checkAllOffers" value="option">
                                            <label class="form-check-label" for="checkAllOffers"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Offer Title</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Discount</th>
                                    <th class="border-0">Start Date</th>
                                    <th class="border-0">End Date</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($offers as $offer)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="offer{{ $offer->id }}" value="option{{ $offer->id }}">
                                                <label class="form-check-label" for="offer{{ $offer->id }}"></label>
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
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this offer?')">
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
                                            <i class="ri-coupon-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No offers found.</p>
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

    {{-- Static View Offer Modal --}}
    <div class="modal fade" id="viewOfferModal" tabindex="-1" aria-labelledby="viewOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewOfferModalLabel">View Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('assets/images/offer-sample-1.jpg') }}" alt="Offer Preview" class="img-fluid mb-3">
                    <p><strong>Title:</strong> Winter Clearance Sale</p>
                    <p><strong>Description:</strong> Up to 50% off on all winter apparel</p>
                    <p><strong>Discount:</strong> 50%</p>
                    <p><strong>Start Date:</strong> 2025-12-01</p>
                    <p><strong>End Date:</strong> 2025-12-31</p>
                    <p><strong>Status:</strong> Active</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Offer Modal --}}
    <div class="modal fade" id="editOfferModal" tabindex="-1" aria-labelledby="editOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOfferModalLabel">Edit Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="offerTitle" class="form-label">Offer Title</label>
                            <input type="text" class="form-control" id="offerTitle" value="Winter Clearance Sale">
                        </div>
                        <div class="mb-3">
                            <label for="offerDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="offerDescription" rows="3">Up to 50% off on all winter apparel</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount</label>
                            <input type="text" class="form-control" id="discount" value="50%">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="startDate" value="2025-12-01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="endDate" value="2025-12-31">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="active">Active</option>
                                <option value="paused">Paused</option>
                                <option value="expired">Expired</option>
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

    {{-- Static Delete Offer Modal --}}
    <div class="modal fade" id="deleteOfferModal" tabindex="-1" aria-labelledby="deleteOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOfferModalLabel">Delete Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this offer? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection