@extends('layouts.area_operator')

@section('title', 'Salesmen')

@section('content')
<div class="container-fluid">

    <h4 class="mb-3">Salesmen List</h4>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DEO</th>
                        <th>Last Login</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salesmen as $salesman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $salesman->name }}</td>
                            <td>{{ $salesman->email }}</td>
                            <td>{{ $salesman->phone_number ?? '-' }}</td>

                            {{-- DEO NAME --}}
                            <td>
                                {{ $salesman->deo->name ?? 'Not Assigned' }}
                            </td>

                            <td>
                                {{ $salesman->last_login_at ?? 'Never' }}
                            </td>

                            <td>
                                <a href="{{ route('area.salesmen.show', $salesman->id) }}"
                                   class="btn btn-sm btn-info">
                                    <i class="ri-eye-line"></i>
                                </a>

                                <a href="{{ route('area.salesmen.edit', $salesman->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="ri-edit-line"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No salesmen found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
