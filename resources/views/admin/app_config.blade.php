{{-- resources/views/admin/settings/app-configuration.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy settings data (in real app, fetch from DB)
    $settings = (object) [
        'maintenance_mode' => false,
        'user_registration' => true,
        'service_provider' => true,
        'shop_owners' => true,
        'advertisements' => true,
        'offers_promotions' => true,
        'rewards_system' => true,
        'gift_cards_wallet' => true,
        'push_notifications' => true,
        'email_notifications' => true,
        'analytics_tracking' => true,
    ];
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">App Configuration</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Profile & Settings</a></li>
                        <li class="breadcrumb-item active">App Configuration</li>
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

    {{-- Feature Configuration --}}
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Feature Enable/Disable</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-md">
                            <input class="form-check-input" type="checkbox" id="maintenanceMode" name="maintenance_mode" {{ old('maintenance_mode', $settings->maintenance_mode) ? 'checked' : '' }}>
                            <label class="form-check-label" for="maintenanceMode">Maintenance Mode</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{" method="POST" id="appConfigForm">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="userRegistration" name="user_registration" {{ old('user_registration', $settings->user_registration) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="userRegistration">User Registration</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="serviceProvider" name="service_provider" {{ old('service_provider', $settings->service_provider) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="serviceProvider">Service Provider Features</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="shopOwners" name="shop_owners" {{ old('shop_owners', $settings->shop_owners) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="shopOwners">Shop Owner Listings</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="advertisements" name="advertisements" {{ old('advertisements', $settings->advertisements) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="advertisements">Advertisements</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="offersPromotions" name="offers_promotions" {{ old('offers_promotions', $settings->offers_promotions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="offersPromotions">Offers & Promotions</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="rewardsSystem" name="rewards_system" {{ old('rewards_system', $settings->rewards_system) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rewardsSystem">Rewards System</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="giftCardsWallet" name="gift_cards_wallet" {{ old('gift_cards_wallet', $settings->gift_cards_wallet) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="giftCardsWallet">Gift Cards & Wallet</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="pushNotifications" name="push_notifications" {{ old('push_notifications', $settings->push_notifications) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pushNotifications">Push Notifications</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="emailNotifications" name="email_notifications" {{ old('email_notifications', $settings->email_notifications) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="emailNotifications">Email Notifications</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch form-switch-md">
                                        <input class="form-check-input" type="checkbox" id="analyticsTracking" name="analytics_tracking" {{ old('analytics_tracking', $settings->analytics_tracking) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="analyticsTracking">Analytics Tracking</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Configuration</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Configuration Notes</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-primary rounded-circle fs-2">
                                <i class="ri-lightbulb-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">Feature Impact</h6>
                            <p class="text-muted mb-0">Disabling a feature will immediately affect user experience. Test in staging first.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-success rounded-circle fs-2">
                                <i class="ri-check-double-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">Sync Status</h6>
                            <p class="text-muted mb-0">Changes sync to production in 5-10 minutes. Monitor logs for errors.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title bg-light text-warning rounded-circle fs-2">
                                <i class="ri-alert-line"></i>
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fs-16 mb-0 fw-semibold">Backup</h6>
                            <p class="text-muted mb-0">All configurations are auto-backed up. Restore from Activity Logs if needed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection