{{-- resources/views/admin/rewards/reward-rules.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Reward Rules
    $rules = collect([
        (object) [
            'id' => 1,
            'type' => 'Earn',
            'type_badge' => 'bg-success',
            'action' => 'Daily Login',
            'points_value' => '+10',
            'description' => 'Points awarded for logging in daily',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 2,
            'type' => 'Earn',
            'type_badge' => 'bg-success',
            'action' => 'Share Listing',
            'points_value' => '+5',
            'description' => 'Points for sharing a listing on social media',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
        (object) [
            'id' => 3,
            'type' => 'Use',
            'type_badge' => 'bg-warning',
            'action' => 'Discount Voucher',
            'points_value' => '-100',
            'description' => 'Redeem 100 points for $1 discount',
            'status' => 'Active',
            'status_badge' => 'bg-success',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Reward Rules</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Rewards System</a></li>
                        <li class="breadcrumb-item active">Reward Rules</li>
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

    {{-- Reward Rules Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Earning & Redemption Rules</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-primary btn-sm material-shadow-none" data-bs-toggle="modal" data-bs-target="#addRuleModal">
                            <i class="ri-add-line align-middle"></i> Add New Rule
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAllRules" value="option">
                                            <label class="form-check-label" for="checkAllRules"></label>
                                        </div>
                                    </th>
                                    <th class="border-0">Rule Type</th>
                                    <th class="border-0">Action/Redemption</th>
                                    <th class="border-0">Points Value</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rules as $rule)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rule{{ $rule->id }}" value="option{{ $rule->id }}">
                                                <label class="form-check-label" for="rule{{ $rule->id }}"></label>
                                            </div>
                                        </td>
                                        <td><span class="badge {{ $rule->type_badge }}">{{ $rule->type }}</span></td>
                                        <td>{{ $rule->action }}</td>
                                        <td>{{ $rule->points_value }}</td>
                                        <td>{{ $rule->description }}</td>
                                        <td><span class="badge {{ $rule->status_badge }}">{{ $rule->status }}</span></td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-soft-primary material-shadow-none">
                                                <i class="ri-eye-line"></i> View
                                            </a>
                                            <a href="" class="btn btn-sm btn-soft-warning material-shadow-none">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this rule?')">
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
                                            <i class="ri-rule-line fs-2 text-muted mb-2 d-block"></i>
                                            <p class="text-muted">No reward rules found.</p>
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

    {{-- Static View Rule Modal --}}
    <div class="modal fade" id="viewRuleModal" tabindex="-1" aria-labelledby="viewRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewRuleModalLabel">View Reward Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Type:</strong> Earn</p>
                    <p><strong>Action:</strong> Daily Login</p>
                    <p><strong>Points Value:</strong> +10</p>
                    <p><strong>Description:</strong> Points awarded for logging in daily</p>
                    <p><strong>Status:</strong> Active</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Rule Modal --}}
    <div class="modal fade" id="addRuleModal" tabindex="-1" aria-labelledby="addRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRuleModalLabel">Add New Reward Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ruleType" class="form-label">Rule Type</label>
                            <select class="form-select @error('ruleType') is-invalid @enderror" id="ruleType" name="ruleType" required>
                                <option value="">Select Type</option>
                                <option value="earn" {{ old('ruleType') == 'earn' ? 'selected' : '' }}>Earn</option>
                                <option value="use" {{ old('ruleType') == 'use' ? 'selected' : '' }}>Use</option>
                            </select>
                            @error('ruleType')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="action" class="form-label">Action/Redemption</label>
                            <input type="text" class="form-control @error('action') is-invalid @enderror" id="action" name="action" placeholder="e.g., Daily Login" value="{{ old('action') }}" required>
                            @error('action')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pointsValue" class="form-label">Points Value</label>
                            <input type="number" class="form-control @error('pointsValue') is-invalid @enderror" id="pointsValue" name="pointsValue" placeholder="e.g., 10" value="{{ old('pointsValue') }}" required>
                            @error('pointsValue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2" placeholder="Brief description of the rule">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Rule</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Rule Modal --}}
    <div class="modal fade" id="editRuleModal" tabindex="-1" aria-labelledby="editRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRuleModalLabel">Edit Reward Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="ruleType" class="form-label">Rule Type</label>
                            <select class="form-select" id="ruleType">
                                <option value="earn">Earn</option>
                                <option value="use">Use</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="action" class="form-label">Action/Redemption</label>
                            <input type="text" class="form-control" id="action" value="Daily Login">
                        </div>
                        <div class="mb-3">
                            <label for="pointsValue" class="form-label">Points Value</label>
                            <input type="number" class="form-control" id="pointsValue" value="10">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="2">Points awarded for logging in daily</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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

    {{-- Static Delete Rule Modal --}}
    <div class="modal fade" id="deleteRuleModal" tabindex="-1" aria-labelledby="deleteRuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRuleModalLabel">Delete Reward Rule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this reward rule? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection