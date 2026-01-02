@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h4 class="mb-3">Create Plan</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= CREATE FORM ================= --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.plans.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Plan Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount (₹)</label>
                    <input type="number" name="amount" class="form-control" required>
                </div>

                <button class="btn btn-primary">Save Plan</button>
            </form>
        </div>
    </div>

    {{-- ================= LIST OF PLANS ================= --}}
    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Existing Plans</h5>

            @if($plans->isEmpty())
                <p class="text-muted">No plans found.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Amount (₹)</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $plan->title }}</td>
                                <td>{{ $plan->description }}</td>
                                <td>{{ $plan->amount }}</td>
                                <td>{{ $plan->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.plans.edit', $plan->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this plan?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>

</div>
@endsection
