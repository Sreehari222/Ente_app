{{-- resources/views/admin/offers/create.blade.php --}}
@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Create Offer</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Offers & Promotions</a></li>
                        <li class="breadcrumb-item active">Create Offer</li>
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
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Create New Offer Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add New Offer</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-soft-secondary btn-sm material-shadow-none">
                            <i class="ri-arrow-left-line align-middle"></i> Back to All Offers
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="offerTitle" class="form-label">Offer Title</label>
                                    <input type="text" class="form-control @error('offerTitle') is-invalid @enderror" id="offerTitle" name="offerTitle" placeholder="Enter offer title" value="{{ old('offerTitle') }}" required>
                                    @error('offerTitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discountType" class="form-label">Discount Type</label>
                                    <select class="form-select @error('discountType') is-invalid @enderror" id="discountType" name="discountType" required>
                                        <option value="">Select Type</option>
                                        <option value="percentage" {{ old('discountType') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                        <option value="fixed" {{ old('discountType') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                        <option value="bogo" {{ old('discountType') == 'bogo' ? 'selected' : '' }}>Buy One Get One (BOGO)</option>
                                    </select>
                                    @error('discountType')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discountValue" class="form-label">Discount Value</label>
                                    <input type="number" class="form-control @error('discountValue') is-invalid @enderror" id="discountValue" name="discountValue" placeholder="e.g., 20 for 20%" value="{{ old('discountValue') }}" step="0.01" required>
                                    @error('discountValue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="applicableTo" class="form-label">Applicable To</label>
                                    <select class="form-select @error('applicableTo') is-invalid @enderror" id="applicableTo" name="applicableTo[]" multiple>
                                        <option value="all" {{ in_array('all', old('applicableTo', [])) ? 'selected' : '' }}>All Products/Services</option>
                                        <option value="electronics" {{ in_array('electronics', old('applicableTo', [])) ? 'selected' : '' }}>Electronics</option>
                                        <option value="groceries" {{ in_array('groceries', old('applicableTo', [])) ? 'selected' : '' }}>Groceries</option>
                                        <option value="apparel" {{ in_array('apparel', old('applicableTo', [])) ? 'selected' : '' }}>Apparel</option>
                                    </select>
                                    <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
                                    @error('applicableTo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control @error('startDate') is-invalid @enderror" id="startDate" name="startDate" value="{{ old('startDate') }}" required>
                                    @error('startDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control @error('endDate') is-invalid @enderror" id="endDate" name="endDate" value="{{ old('endDate') }}" required>
                                    @error('endDate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="offerDescription" class="form-label">Description</label>
                            <textarea class="form-control @error('offerDescription') is-invalid @enderror" id="offerDescription" name="offerDescription" rows="3" placeholder="Enter offer description">{{ old('offerDescription') }}</textarea>
                            @error('offerDescription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="offerImage" class="form-label">Offer Image Upload</label>
                                    <input type="file" class="form-control @error('offerImage') is-invalid @enderror" id="offerImage" name="offerImage" accept="image/*">
                                    <small class="text-muted">Upload image for offer banner (Max 5MB)</small>
                                    @error('offerImage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="targetUrl" class="form-label">Target URL (Optional)</label>
                                    <input type="url" class="form-control @error('targetUrl') is-invalid @enderror" id="targetUrl" name="targetUrl" placeholder="https://example.com/offer-details" value="{{ old('targetUrl') }}">
                                    @error('targetUrl')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="offerStatus" class="form-label">Initial Status</label>
                            <select class="form-select @error('offerStatus') is-invalid @enderror" id="offerStatus" name="offerStatus">
                                <option value="active" {{ old('offerStatus') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="draft" {{ old('offerStatus') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="scheduled" {{ old('offerStatus') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            </select>
                            @error('offerStatus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Offer</button>
                            <a href="" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection