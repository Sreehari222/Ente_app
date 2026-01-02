{{-- resources/views/admin/rewards/spin-win.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Spin Wheel Prizes
    $prizes = collect([
        (object) [
            'id' => 1,
            'name' => '100 Points',
            'type' => 'Points',
            'type_badge' => 'bg-primary',
            'description' => 'Bonus points for lucky spins',
            'value' => '100',
            'probability' => 25,
            'color' => '#007bff',
        ],
        (object) [
            'id' => 2,
            'name' => '$5 Coupon',
            'type' => 'Coupon',
            'type_badge' => 'bg-success',
            'description' => 'Discount on next purchase',
            'value' => '$5',
            'probability' => 15,
            'color' => '#28a745',
        ],
        (object) [
            'id' => 3,
            'name' => 'Free Spin',
            'type' => 'Retry',
            'type_badge' => 'bg-warning',
            'description' => 'One extra wheel spin',
            'value' => '1',
            'probability' => 10,
            'color' => '#ffc107',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Spin & Win Setup</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Rewards System</a></li>
                        <li class="breadcrumb-item active">Spin & Win Setup</li>
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

    {{-- Spin Wheel Prizes Grid --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Wheel Prize Segments</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-primary btn-sm material-shadow-none">
                            <i class="ri-add-line align-middle"></i> Add New Prize
                        </a>
                        <button type="button" class="btn btn-info btn-sm material-shadow-none ms-1" data-bs-toggle="modal" data-bs-target="#previewWheelModal">
                            <i class="ri-eye-line align-middle"></i> Preview Wheel
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @forelse($prizes as $prize)
                            <div class="col-md-4 col-sm-6">
                                <div class="card prize-card h-100 border-primary">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title mb-0 fw-semibold text-primary">{{ $prize->name }}</h6>
                                            <span class="badge {{ $prize->type_badge }}">{{ $prize->type }}</span>
                                        </div>
                                        <p class="card-text text-muted small flex-grow-1">{{ $prize->description }}</p>
                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="text-muted">Probability</small>
                                            <small class="fw-semibold">{{ $prize->probability }}%</small>
                                        </div>
                                        <div class="probability-bar" style="--width: {{ $prize->probability }}%;"></div>
                                        <div class="d-flex gap-1 mt-3">
                                            <a href="" class="btn btn-sm btn-soft-primary flex-fill">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline; flex: 1;" onsubmit="return confirm('Delete this prize?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger w-100">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="ri-wheel-line fs-1 text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">No prizes configured.</h5>
                                    <p class="text-muted">Add your first prize to start the spin wheel.</p>
                                </div>
                            </div>
                        @endforelse
                        <div class="col-md-4 col-sm-6">
                            <div class="card prize-card h-100 border-info text-center" data-bs-toggle="modal" data-bs-target="#addPrizeModal">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <div>
                                        <i class="ri-add-circle-line fs-1 text-info mb-2"></i>
                                        <h6 class="text-info">Add Prize</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Add Prize Modal --}}
    <div class="modal fade" id="addPrizeModal" tabindex="-1" aria-labelledby="addPrizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPrizeModalLabel">Add New Prize</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="prizeName" class="form-label">Prize Name</label>
                            <input type="text" class="form-control @error('prizeName') is-invalid @enderror" id="prizeName" name="prizeName" placeholder="e.g., 100 Points" value="{{ old('prizeName') }}" required>
                            @error('prizeName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prizeType" class="form-label">Type</label>
                            <select class="form-select @error('prizeType') is-invalid @enderror" id="prizeType" name="prizeType" required>
                                <option value="">Select Type</option>
                                <option value="points" {{ old('prizeType') == 'points' ? 'selected' : '' }}>Points</option>
                                <option value="coupon" {{ old('prizeType') == 'coupon' ? 'selected' : '' }}>Coupon</option>
                                <option value="retry" {{ old('prizeType') == 'retry' ? 'selected' : '' }}>Retry</option>
                            </select>
                            @error('prizeType')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prizeValue" class="form-label">Value</label>
                            <input type="text" class="form-control @error('prizeValue') is-invalid @enderror" id="prizeValue" name="prizeValue" placeholder="e.g., 100" value="{{ old('prizeValue') }}" required>
                            @error('prizeValue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="probability" class="form-label">Probability (%)</label>
                            <input type="number" class="form-control @error('probability') is-invalid @enderror" id="probability" name="probability" min="0" max="100" placeholder="e.g., 25" value="{{ old('probability') }}" required>
                            @error('probability')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="segmentColor" class="form-label">Segment Color</label>
                            <input type="color" class="form-control form-control-color @error('segmentColor') is-invalid @enderror" id="segmentColor" name="segmentColor" value="{{ old('segmentColor', '#007bff') }}">
                            @error('segmentColor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addPrizeForm" class="btn btn-primary">Add Prize</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Prize Modal --}}
    <div class="modal fade" id="editPrizeModal" tabindex="-1" aria-labelledby="editPrizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPrizeModalLabel">Edit Prize</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="prizeName" class="form-label">Prize Name</label>
                            <input type="text" class="form-control" id="prizeName" value="100 Points">
                        </div>
                        <div class="mb-3">
                            <label for="prizeType" class="form-label">Type</label>
                            <select class="form-select" id="prizeType">
                                <option>Points</option>
                                <option>Coupon</option>
                                <option>Retry</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="prizeValue" class="form-label">Value</label>
                            <input type="text" class="form-control" id="prizeValue" value="100">
                        </div>
                        <div class="mb-3">
                            <label for="probability" class="form-label">Probability (%)</label>
                            <input type="number" class="form-control" id="probability" value="25" min="0" max="100">
                        </div>
                        <div class="mb-3">
                            <label for="segmentColor" class="form-label">Segment Color</label>
                            <input type="color" class="form-control form-control-color" id="segmentColor" value="#007bff">
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

    {{-- Static Preview Wheel Modal --}}
    <div class="modal fade" id="previewWheelModal" tabindex="-1" aria-labelledby="previewWheelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewWheelModalLabel">Wheel Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div style="width: 300px; height: 300px; margin: 0 auto; border: 3px solid #ddd; border-radius: 50%; position: relative; background: conic-gradient(#007bff 0% 25%, #28a745 25% 40%, #ffc107 40% 50%, #dc3545 50% 100%);">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; background: #fff; border-radius: 50%; z-index: 1;"></div>
                    </div>
                    <p class="mt-3">Spin the wheel to win prizes!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection