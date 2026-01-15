@extends('layouts.deo')

@section('content')
<div class="container-fluid">

    <!-- Page Title -->
    <div class="row mb-3">
        <div class="col">
            <h4 class="fw-bold">My Salesmen</h4>
            <p class="text-muted mb-0">List of salesmen assigned to you</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.salesmen.create') }}" class="btn btn-success">
                <i class="ri-add-line"></i> Add Salesman
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($salesmen as $index => $salesman)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>
                                    <div class="fw-semibold">{{ $salesman->name }}</div>
                                    <small class="text-muted">
                                        ID: {{ $salesman->id }}
                                    </small>
                                </td>

                                <td>{{ $salesman->email }}</td>

                                <td>
                                    {{ $salesman->salesmanProfile->mobile ?? '-' }}
                                </td>

                                <td>
                                    @php
                                        $status = $salesman->salesmanProfile->status ?? 'active';
                                    @endphp

                                    <span class="badge
                                        {{ $status == 'active' ? 'bg-success' :
                                           ($status == 'inactive' ? 'bg-warning' : 'bg-danger') }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $salesman->created_at->format('d M Y') }}
                                </td>

                                <!-- Actions -->
                               <td class="text-center">
    <div class="d-flex justify-content-center gap-2">

        <a href="{{ route('salesmen.show', $salesman->id) }}"
           class="btn btn-sm btn-outline-info"
           title="View">
            <i class="ri-eye-line"></i>
        </a>

        <a href="{{ route('salesmen.edit', $salesman->id) }}"
           class="btn btn-sm btn-outline-warning"
           title="Edit">
            <i class="ri-edit-line"></i>
        </a>

        <form action="{{ route('salesmen.destroy', $salesman->id) }}"
              method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="btn btn-sm btn-outline-danger"
                    title="Delete"
                    onclick="return confirm('Are you sure?')">
                <i class="ri-delete-bin-line"></i>
            </button>
        </form>

    </div>
</td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No salesmen assigned yet
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
