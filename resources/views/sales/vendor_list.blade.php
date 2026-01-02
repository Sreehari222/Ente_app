@extends('layouts.sales')

@section('title', 'My Vendors')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">My Vendors</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('sales.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Vendor List</li>
                </ol>
            </div>
        </div>
    </div>

    {{-- Search Filters --}}
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="">
                <div class="row g-3">

                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Search by Name"
                            value="{{ request('name') }}">
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="category" class="form-control" placeholder="Category"
                            value="{{ request('category') }}">
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="ward" class="form-control" placeholder="Ward / Area"
                            value="{{ request('ward') }}">
                    </div>

                    <div class="col-md-2">
                        <select name="plan_id" class="form-select">
                            <option value="">Plan Type</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ request('plan_id') == $i ? 'selected' : '' }}>
                                    Plan {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-primary me-1">
                            <i class="ri-search-line"></i> Search
                        </button>
                        <a href="" class="btn btn-light">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Vendor Table --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Shop</th>
                            <th>Category</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Verification</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vendors as $vendor)
                            <tr>
                                <td>
                                    <strong>{{ $vendor->shop_name }}</strong><br>
                                    <small class="text-muted">{{ $vendor->owner_name }}</small>
                                </td>

                                <td>{{ $vendor->category->name }}</td>

                                <td>
                                    {{ $vendor->mobile }}<br>
                                    <small>{{ $vendor->whatsapp }}</small>
                                </td>

                                <td>{{ $vendor->address }}</td>

                                <td>
                                    <span class="badge bg-info">Plan {{ $vendor->plan_id }}</span>
                                </td>

                                <td>
                                    @if ($vendor->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Disabled</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $verificationClass = match ($vendor->verification_status) {
                                            'Approved' => 'bg-success',
                                            'Pending' => 'bg-warning',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $verificationClass }}">
                                        {{ $vendor->verification_status }}
                                    </span>
                                </td>


                                <td>
                                    <a href="{{ route('sales.vendors.edit', $vendor->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <form action="{{ route('sales.vendors.toggle', $vendor->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-warning">
                                            {{ $vendor->is_active ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    No vendors found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $vendors->links() }}
            </div>
        </div>
    </div>
@endsection
