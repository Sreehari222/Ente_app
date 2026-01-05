@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0">Daily Challenges</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Rewards System</li>
                    <li class="breadcrumb-item active">Daily Challenges</li>
                </ol>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Manage Daily Challenges</h4>
<a href="{{ route('admin.daily_challenges.create') }}" class="btn btn-primary btn-sm">
            <i class="ri-add-line"></i> Create New Challenge
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Reward</th>
                        <th>Active Date</th>
                        <th>Status</th>
                        <th width="160">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($challenges as $challenge)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $challenge->name }}</td>
                            <td>{{ $challenge->description }}</td>
                            <td>{{ $challenge->reward_points }}</td>
                            <td>{{ $challenge->active_date }}</td>
                            <td>
                                <span class="badge
                                    @if($challenge->status === 'active') bg-success
                                    @elseif($challenge->status === 'scheduled') bg-warning
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($challenge->status) }}
                                </span>
                            </td>
                            <td>
                                <a href=""
                                   class="btn btn-sm btn-soft-warning">
                                    <i class="ri-edit-line"></i>
                                </a>

                                <form action=""
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this challenge?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No daily challenges found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $challenges->links() }}
        </div>
    </div>
</div>

@endsection
