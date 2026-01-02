{{-- resources/views/admin/rewards/scratch-cards.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Scratch Cards
    $cards = collect([
        (object) [
            'id' => 1,
            'name' => 'Golden Scratch Card',
            'reward_type' => 'Voucher',
            'reward_badge' => 'bg-success',
            'reward_value' => '$10 Voucher',
            'description' => 'Scratch to reveal instant rewards',
            'win_rate' => 20,
            'preview_style' => 'background: linear-gradient(45deg, #ffd700, #b56218ff);',
        ],
        (object) [
            'id' => 2,
            'name' => 'Daily Scratch',
            'reward_type' => 'Points',
            'reward_badge' => 'bg-warning',
            'reward_value' => '50 Points',
            'description' => 'Quick daily reward scratch',
            'win_rate' => 35,
            'preview_style' => 'background: linear-gradient(45deg, #a8e6cf, #ffd3a5);',
        ],
        (object) [
            'id' => 3,
            'name' => 'Premium Scratch',
            'reward_type' => 'Item',
            'reward_badge' => 'bg-info',
            'reward_value' => 'Free Item',
            'description' => 'High-value rewards for users',
            'win_rate' => 10,
            'preview_style' => 'background: linear-gradient(45deg, #ff9a9e, #fecfef);',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Scratch Cards</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Rewards System</a></li>
                        <li class="breadcrumb-item active">Scratch Cards</li>
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

    {{-- Scratch Cards Grid --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Manage Scratch Card Rewards</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-primary btn-sm material-shadow-none">
                            <i class="ri-add-line align-middle"></i> Create New Card
                        </a>
                        <button type="button" class="btn btn-info btn-sm material-shadow-none ms-1" data-bs-toggle="modal" data-bs-target="#previewCardModal">
                            <i class="ri-eye-line align-middle"></i> Preview Card
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @forelse($cards as $card)
                            <div class="col-md-4 col-sm-6">
                                <div class="card scratch-card h-100">
                                   <div class="scratch-preview" @style($card->preview_style)>
    <span class="reward-badge {{ $card->reward_badge }}">{{ $card->reward_value }}</span>

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    Scratch to Reveal!
</div>

</div>

                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title mb-2 fw-semibold">{{ $card->name }}</h6>
                                        <p class="card-text text-muted small flex-grow-1">{{ $card->description }}</p>
                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="text-muted">Win Rate</small>
                                            <small class="fw-semibold">{{ $card->win_rate }}%</small>
                                        </div>
                                        <div class="probability-bars mb-3" style="--width: {{ $card->win_rate }}%;"></div>
                                        <div class="d-flex gap-1">
                                            <a href="" class="btn btn-sm btn-soft-primary flex-fill">
                                                <i class="ri-edit-line"></i> Edit
                                            </a>
                                            <form action="" method="POST" style="display: inline; flex: 1;" onsubmit="return confirm('Delete this card?')">
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
                                    <i class="ri-scratch-card-line fs-1 text-muted mb-3 d-block"></i>
                                    <h5 class="text-muted">No scratch cards configured.</h5>
                                    <p class="text-muted">Create your first scratch card to engage users.</p>
                                </div>
                            </div>
                        @endforelse
                        <div class="col-md-4 col-sm-6">
                            <div class="card scratch-card h-100 text-center" data-bs-toggle="modal" data-bs-target="#addCardModal">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <div>
                                        <i class="ri-add-circle-line fs-1 text-primary mb-2"></i>
                                        <h6 class="text-primary">Add Card</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Card Modal --}}
    <div class="modal fade" id="addCardModal" tabindex="-1" aria-labelledby="addCardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCardModalLabel">Create New Scratch Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Card Name</label>
                            <input type="text" class="form-control @error('cardName') is-invalid @enderror" id="cardName" name="cardName" placeholder="e.g., Golden Scratch Card" value="{{ old('cardName') }}" required>
                            @error('cardName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rewardType" class="form-label">Reward Type</label>
                            <select class="form-select @error('rewardType') is-invalid @enderror" id="rewardType" name="rewardType" required>
                                <option value="">Select Type</option>
                                <option value="voucher" {{ old('rewardType') == 'voucher' ? 'selected' : '' }}>Voucher</option>
                                <option value="points" {{ old('rewardType') == 'points' ? 'selected' : '' }}>Points</option>
                                <option value="item" {{ old('rewardType') == 'item' ? 'selected' : '' }}>Item</option>
                            </select>
                            @error('rewardType')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rewardValue" class="form-label">Reward Value</label>
                            <input type="text" class="form-control @error('rewardValue') is-invalid @enderror" id="rewardValue" name="rewardValue" placeholder="e.g., $10" value="{{ old('rewardValue') }}" required>
                            @error('rewardValue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="winRate" class="form-label">Win Rate (%)</label>
                            <input type="number" class="form-control @error('winRate') is-invalid @enderror" id="winRate" name="winRate" min="0" max="100" placeholder="e.g., 20" value="{{ old('winRate') }}" required>
                            @error('winRate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cardColor" class="form-label">Card Color Gradient</label>
                            <input type="color" class="form-control form-control-color @error('cardColor') is-invalid @enderror" id="cardColor" name="cardColor" value="{{ old('cardColor', '#ff6b6b') }}">
                            <input type="color" class="form-control form-control-color mt-1 @error('cardColor2') is-invalid @enderror" id="cardColor2" name="cardColor2" value="{{ old('cardColor2', '#4ecdc4') }}">
                            @error('cardColor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('cardColor2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Card</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Static Edit Card Modal --}}
    <div class="modal fade" id="editCardModal" tabindex="-1" aria-labelledby="editCardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCardModalLabel">Edit Scratch Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Card Name</label>
                            <input type="text" class="form-control" id="cardName" value="Golden Scratch Card">
                        </div>
                        <div class="mb-3">
                            <label for="rewardType" class="form-label">Reward Type</label>
                            <select class="form-select" id="rewardType">
                                <option>Voucher</option>
                                <option>Points</option>
                                <option>Item</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rewardValue" class="form-label">Reward Value</label>
                            <input type="text" class="form-control" id="rewardValue" value="$10">
                        </div>
                        <div class="mb-3">
                            <label for="winRate" class="form-label">Win Rate (%)</label>
                            <input type="number" class="form-control" id="winRate" value="20" min="0" max="100">
                        </div>
                        <div class="mb-3">
                            <label for="cardColor" class="form-label">Card Color Gradient</label>
                            <input type="color" class="form-control form-control-color" id="cardColor" value="#ff6b6b">
                            <input type="color" class="form-control form-control-color mt-1" id="cardColor2" value="#4ecdc4">
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

    {{-- Static Preview Card Modal --}}
    <div class="modal fade" id="previewCardModal" tabindex="-1" aria-labelledby="previewCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewCardModalLabel">Scratch Card Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div style="width: 250px; height: 150px; margin: 0 auto; border-radius: 8px; background: linear-gradient(45deg, #ff6b6b, #4ecdc4); position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Scratch to Reveal!</div>
                    </div>
                    <p class="mt-3">Users can scratch the surface to uncover rewards.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection