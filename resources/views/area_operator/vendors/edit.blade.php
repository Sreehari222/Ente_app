@extends('layouts.area_operator')

@section('content')
    <div class="container-fluid">

        <h4 class="mb-4">Edit Vendor</h4>

        <form method="POST" action="{{ route('area.vendors.update', $vendor->id) }}">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-body row">

                    {{-- SHOP NAME --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Shop Name</label>
                        <input type="text" name="shop_name" class="form-control" value="{{ $vendor->shop_name }}" required>
                    </div>

                    {{-- OWNER NAME --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Owner Name</label>
                        <input type="text" name="owner_name" class="form-control" value="{{ $vendor->owner_name }}">
                    </div>

                    {{-- MOBILE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="{{ $vendor->mobile }}" required>
                    </div>

                    {{-- EMAIL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $vendor->email }}">
                    </div>

                    {{-- SERVICE AREA --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Service Area</label>
                        <input type="text" name="service_area" class="form-control" value="{{ $vendor->service_area }}">
                    </div>

                    {{-- MAIN CATEGORY --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Main Category</label>
                        <select id="main_category" name="main_category_id" class="form-select" required>
                            <option value="">Select Main Category</option>
                            @foreach ($mainCategories as $main)
                                <option value="{{ $main->id }}"
                                    {{ $vendor->main_category_id == $main->id ? 'selected' : '' }}>
                                    {{ $main->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SUB CATEGORY --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sub Category</label>
                        <select id="subcategory" name="category_id" class="form-select" required>
                            <option value="">Select Sub Category</option>
                            @foreach ($subCategories as $sub)
                                <option value="{{ $sub->id }}"
                                    {{ $vendor->category_id == $sub->id ? 'selected' : '' }}>
                                    {{ $sub->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- PLAN --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Plan</label>
                        <select name="plan_id" class="form-select" required>
                            <option value="">Select Plan</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" {{ $vendor->plan_id == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->title ?? 'Unnamed Plan' }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                </div>

                <div class="card-footer text-end">
                    <button class="btn btn-primary">Update Vendor</button>
                </div>
            </div>
        </form>
    </div>

    {{-- DEPENDENT CATEGORY SCRIPT --}}
    <script>
        document.getElementById('main_category').addEventListener('change', function() {
            fetch(`/area/categories/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    let sub = document.getElementById('subcategory');
                    sub.innerHTML = '<option value="">Select Sub Category</option>';
                    data.forEach(cat => {
                        sub.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                    });
                });
        });
    </script>
@endsection
