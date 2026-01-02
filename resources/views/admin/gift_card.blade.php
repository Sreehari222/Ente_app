{{-- resources/views/admin/gift-cards/index.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Gift Card Types
    $giftCards = collect([
        (object) [
            'id' => 1,
            'name' => 'Standard Gift Card',
            'value' => '$25',
            'currency' => 'USD',
            'validity' => 365,
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 2,
            'name' => 'Premium Gift Card',
            'value' => '$100',
            'currency' => 'USD',
            'validity' => 730,
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 3,
            'name' => 'Corporate Gift Card',
            'value' => '$500',
            'currency' => 'USD',
            'validity' => 1095,
            'status' => 'Paused',
            'status_badge' => 'bg-warning',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Gift Card Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Gift Cards & Wallet</a></li>
                        <li class="breadcrumb-item active">Gift Card Management</li>
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

    {{-- Gift Card Types Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Gift Card Types</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-primary btn-sm material-shadow-none" data-bs-toggle="modal" data-bs-target="#addGiftCardModal">
                            <i class="ri-add-line align-middle"></i> Add New Type
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAllGiftCards" value="option">
                                            <label class="form-check-label" for="checkAllGiftCards"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Type Name</th>
                                    <th class="border-0">Value</th>
                                    <th class="border-0">Currency</th>
                                    <th class="border-0">Validity (Days)</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($giftCards as $giftCard)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="giftCard{{ $giftCard->id }}" value="option{{ $giftCard->id }}">
                                                <label class="form-check-label" for="giftCard{{ $giftCard->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $giftCard->name }}</td>
                                        <td>{{ $giftCard->value }}</td>
                                        <td>{{ $giftCard->currency }}</td>
                                        <td>{{ $giftCard->validity }}</td>
                                        <td><span class="badge {{ $giftCard->status_badge }}">{{ $giftCard->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-soft-primary material-shadow-none">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            <a href="" class="btn btn-sm btn-soft-warning material-shadow-none">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this gift card type?')">
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
                                            <i class="ri-gift-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No gift card types found.</p>
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

    {{-- Static View Gift Card Modal --}}
    <div class="modal fade" id="viewGiftCardModal" tabindex="-1" aria-labelledby="viewGiftCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewGiftCardModalLabel">View Gift Card Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('assets/images/gift-card-sample.jpg') }}" alt="Gift Card Preview" class="img-fluid mb-3 rounded">
                    <p><strong>Type Name:</strong> Standard Gift Card</p>
                    <p><strong>Value:</strong> $25</p>
                    <p><strong>Currency:</strong> USD</p>
                    <p><strong>Validity:</strong> 365 days</p>
                    <p><strong>Status:</strong> Active</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Gift Card Modal --}}
    <div class="modal fade" id="addGiftCardModal" tabindex="-1" aria-labelledby="addGiftCardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGiftCardModalLabel">Add New Gift Card Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="typeName" class="form-label">Type Name</label>
                            <input type="text" class="form-control @error('typeName') is-invalid @enderror" id="typeName" name="typeName" placeholder="e.g., Standard Gift Card" value="{{ old('typeName') }}" required>
                            @error('typeName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="value" class="form-label">Value</label>
                            <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" placeholder="e.g., 25" value="{{ old('value') }}" step="0.01" required>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select @error('currency') is-invalid @enderror" id="currency" name="currency" required>
                                <option value="">Select Currency</option>
                                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                <option value="INR" {{ old('currency') == 'INR' ? 'selected' : '' }}>INR</option>
                            </select>
                            @error('currency')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validity" class="form-label">Validity (Days)</label>
                            <input type="number" class="form-control @error('validity') is-invalid @enderror" id="validity" name="validity" placeholder="e.g., 365" value="{{ old('validity') }}" required>
                            @error('validity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Initial Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="paused" {{ old('status') == 'paused' ? 'selected' : '' }}>Paused</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Type</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Gift Card Modal --}}
    <div class="modal fade" id="editGiftCardModal" tabindex="-1" aria-labelledby="editGiftCardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGiftCardModalLabel">Edit Gift Card Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="typeName" class="form-label">Type Name</label>
                            <input type="text" class="form-control" id="typeName" value="Standard Gift Card">
                        </div>
                        <div class="mb-3">
                            <label for="value" class="form-label">Value</label>
                            <input type="number" class="form-control" id="value" value="25">
                        </div>
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select" id="currency">
                                <option>USD</option>
                                <option>EUR</option>
                                <option>INR</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="validity" class="form-label">Validity (Days)</label>
                            <input type="number" class="form-control" id="validity" value="365">
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

    {{-- Static Delete Gift Card Modal --}}
    <div class="modal fade" id="deleteGiftCardModal" tabindex="-1" aria-labelledby="deleteGiftCardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGiftCardModalLabel">Delete Gift Card Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this gift card type? This action cannot be undone and may affect existing cards.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection