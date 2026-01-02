@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col">
            <h4 class="mb-0">Create Plan</h4>
            <small class="text-muted">Manage subscription / listing plans</small>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
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

            <form method="POST" action="{{ route('admin.plans.store') }}">
                @csrf

                {{-- Price --}}
                <div class="mb-3">
                    <label class="form-label">Price (₹)</label>
                    <input type="number" name="price" class="form-control" 
                           placeholder="Enter plan price" required>
                </div>

                {{-- Validity Duration --}}
                <div class="mb-3">
                    <label class="form-label">Validity Duration (Days)</label>
                    <input type="number" name="validity_days" class="form-control"
                           placeholder="e.g. 30, 60, 90" required>
                </div>

                {{-- Visibility Priority --}}
                <div class="mb-3">
                    <label class="form-label">Visibility Priority</label>
                    <select name="visibility_priority" class="form-select" required>
                        <option value="">Select priority</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                        <option value="top">Top</option>
                    </select>
                </div>

                {{-- Number of Images Allowed --}}
                <div class="mb-3">
                    <label class="form-label">Number of Images Allowed</label>
                    <input type="number" name="image_limit" class="form-control"
                           placeholder="e.g. 5, 10, 15" required>
                </div>

                {{-- Highlight / Featured Listing --}}
                <div class="mb-3">
                    <label class="form-label">Listing Options</label>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                               name="is_highlighted" value="1" id="highlighted">
                        <label class="form-check-label" for="highlighted">
                            Highlight Listing
                        </label>
                    </div>

                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" 
                               name="is_featured" value="1" id="featured">
                        <label class="form-check-label" for="featured">
                            Featured Listing
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        Save Plan
                    </button>
                    <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
