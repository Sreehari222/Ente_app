{{-- resources/views/admin/listings/categories.blade.php --}}
@extends('layouts.admin')

@section('content')

{{-- ================= SERVICE CATEGORIES ================= --}}
<div class="row">
    <div class="col-12">
        <div class="category-section">
            <h5 class="mb-4 text-center">
                {{ $serviceMain->name ?? 'Service Categories' }}
            </h5>

            <div class="row">
                @forelse($serviceMain->categories ?? [] as $category)
                    <div class="col-md-6 col-lg-4">
                        <div class="card category-item service-category text-center">
                            <div class="category-icon">
                                <i class="ri-tools-line"></i>
                            </div>

                            <h6 class="mb-2">{{ $category->name }}</h6>

                            <p class="text-muted small mb-3">
                                {{ $category->description ?? 'No description available' }}
                            </p>

                            <div class="category-stats">
                                <div class="stat-item">
                                    <div class="stat-number">0</div>
                                    <div class="text-muted small">Listings</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">0</div>
                                    <div class="text-muted small">Active</div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                   class="btn btn-outline-primary btn-sm me-1">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.categories.destroy', $category->id) }}"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Delete this category?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No service categories found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ================= SHOP CATEGORIES ================= --}}
<div class="row mt-5">
    <div class="col-12">
        <div class="category-section">
            <h5 class="mb-4 text-center">
                {{ $shopMain->name ?? 'Shop Categories' }}
            </h5>

            <div class="row">
                @forelse($shopMain->categories ?? [] as $category)
                    <div class="col-md-6 col-lg-4">
                        <div class="card category-item shop-category text-center">
                            <div class="category-icon">
                                <i class="ri-store-line"></i>
                            </div>

                            <h6 class="mb-2">{{ $category->name }}</h6>

                            <p class="text-muted small mb-3">
                                {{ $category->description ?? 'No description available' }}
                            </p>

                            <div class="category-stats">
                                <div class="stat-item">
                                    <div class="stat-number">0</div>
                                    <div class="text-muted small">Listings</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">0</div>
                                    <div class="text-muted small">Active</div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                   class="btn btn-outline-primary btn-sm me-1">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.categories.destroy', $category->id) }}"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Delete this category?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No shop categories found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ================= ADD CATEGORY BUTTON ================= --}}
<button class="add-category-btn" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    <i class="ri-add-line"></i>
</button>

{{-- ================= ADD CATEGORY MODAL ================= --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="modal-body">

                    {{-- Main Category --}}
                    <div class="mb-3">
                        <label class="form-label">Main Category</label>
                        <select name="main_category_id" class="form-select" required>
                            <option value="">Select</option>
                            @foreach($mainCategories as $main)
                                <option value="{{ $main->id }}">{{ $main->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sub Category --}}
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
