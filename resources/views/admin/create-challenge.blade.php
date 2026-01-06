@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex justify-content-between align-items-center">
            <h4>Create Daily Challenge</h4>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="{{ route('admin.daily_challenge.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Challenge Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Reward Points</label>
                <input type="number" name="reward_points" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Active Date</label>
                <input type="date" name="active_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="paused">Paused</option>
                </select>
            </div>

            <div class="text-end">
                <a href="" class="btn btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    Create Challenge
                </button>
            </div>
        </form>

    </div>
</div>

@endsection
