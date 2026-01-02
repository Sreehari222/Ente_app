@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h4 class="mb-3">Edit Plan</h4>

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

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.plans.update', $plan->id) }}">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Plan Title</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $plan->title) }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $plan->description) }}</textarea>
                </div>

                {{-- Amount --}}
                <div class="mb-3">
                    <label class="form-label">Amount (₹)</label>
                    <input type="number" name="amount" class="form-control"
                           value="{{ old('amount', $plan->amount) }}" required>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">Update Plan</button>
                <a href="{{ route('admin.plans.create') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>

</div>
@endsection
