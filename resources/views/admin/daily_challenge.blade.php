{{-- resources/views/admin/rewards/daily-challenges.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Daily Challenges
    $challenges = collect([
        (object) [
            'id' => 1,
            'name' => 'Daily Login Streak',
            'description' => 'Log in every day to earn points',
            'reward_points' => 50,
            'active_date' => '2025-12-04',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 2,
            'name' => 'Share a Listing',
            'description' => 'Share any listing with friends',
            'reward_points' => 30,
            'active_date' => '2025-12-04',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 3,
            'name' => 'Complete Profile',
            'description' => 'Fill out your profile details',
            'reward_points' => 100,
            'active_date' => '2025-12-05',
            'status' => 'Scheduled',
            'status_badge' => 'bg-warning',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Daily Challenges</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Rewards System</a></li>
                        <li class="breadcrumb-item active">Daily Challenges</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Daily Challenges Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Daily Challenges</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-primary btn-sm material-shadow-none">
                            <i class="ri-add-line align-middle"></i> Create New Challenge
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAllChallenges" value="option">
                                            <label class="form-check-label" for="checkAllChallenges"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Challenge Name</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Reward Points</th>
                                    <th class="border-0">Active Date</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($challenges as $challenge)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="challenge{{ $challenge->id }}" value="option{{ $challenge->id }}">
                                                <label class="form-check-label" for="challenge{{ $challenge->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $challenge->name }}</td>
                                        <td>{{ $challenge->description }}</td>
                                        <td>{{ $challenge->reward_points }}</td>
                                        <td>{{ $challenge->active_date }}</td>
                                        <td><span class="badge {{ $challenge->status_badge }}">{{ $challenge->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-soft-primary material-shadow-none">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            <a href="" class="btn btn-sm btn-soft-warning material-shadow-none">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this challenge?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger material-shadow-none">
                                                    <i class="ri-delete-bin-line"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="ri-trophy-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No daily challenges found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        <ul class="pagination pagination-separated pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a href="#" class="page-link">←</a>
                            </li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item active"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">→</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Static View Challenge Modal --}}
    <div class="modal fade" id="viewChallengeModal" tabindex="-1" aria-labelledby="viewChallengeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewChallengeModalLabel">View Daily Challenge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('assets/images/challenge-sample-1.jpg') }}" alt="Challenge Preview" class="img-fluid mb-3">
                    <p><strong>Name:</strong> Daily Login Streak</p>
                    <p><strong>Description:</strong> Log in every day to earn points</p>
                    <p><strong>Reward Points:</strong> 50</p>
                    <p><strong>Active Date:</strong> 2025-12-04</p>
                    <p><strong>Status:</strong> Active</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Challenge Modal --}}
    <div class="modal fade" id="editChallengeModal" tabindex="-1" aria-labelledby="editChallengeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editChallengeModalLabel">Edit Daily Challenge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="challengeName" class="form-label">Challenge Name</label>
                            <input type="text" class="form-control" id="challengeName" value="Daily Login Streak">
                        </div>
                        <div class="mb-3">
                            <label for="challengeDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="challengeDescription" rows="3">Log in every day to earn points</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rewardPoints" class="form-label">Reward Points</label>
                            <input type="number" class="form-control" id="rewardPoints" value="50">
                        </div>
                        <div class="mb-3">
                            <label for="activeDate" class="form-label">Active Date</label>
                            <input type="date" class="form-control" id="activeDate" value="2025-12-04">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="active">Active</option>
                                <option value="scheduled">Scheduled</option>
                                <option value="paused">Paused</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Delete Challenge Modal --}}
    <div class="modal fade" id="deleteChallengeModal" tabindex="-1" aria-labelledby="deleteChallengeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteChallengeModalLabel">Delete Daily Challenge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this daily challenge? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection