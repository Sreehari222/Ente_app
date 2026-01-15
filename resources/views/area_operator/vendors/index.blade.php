@extends('layouts.area_operator')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">My Vendors</h4>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Vendor Name</th>
                            <th>Shop Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Salesman</th>
                            <th>Created At</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($vendors as $vendor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vendor->owner_name }}</td>
                                <td>{{ $vendor->shop_name }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ $vendor->mobile }}</td>
                                <td>
                                    {{ $vendor->salesman->name ?? 'N/A' }}
                                </td>
                                <td>{{ $vendor->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('area.vendors.show', $vendor->id) }}"
                                       class="btn btn-sm btn-info">
                                        View
                                    </a>

                                    <a href="{{ route('area.vendors.edit', $vendor->id) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form action="{{ route('area.vendors.destroy', $vendor->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No vendors found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>
@endsection
