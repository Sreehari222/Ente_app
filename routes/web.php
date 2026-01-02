<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard');

        // User Management
        Route::get('/users', fn () => view('admin.users.index'))->name('all-users');
        Route::get('/service-providers', fn () => view('admin.users.providers'))->name('service-providers');
        Route::get('/shop-owners', fn () => view('admin.users.shop-owners'))->name('shop-owners');
        Route::get('/verification-requests', fn () => view('admin.users.verifications'))->name('verification-requests');
        Route::get('/blocked-users', fn () => view('admin.users.blocked'))->name('blocked-users');

        // Categories
        Route::get('/categories', fn () => view('admin.categories.index'))->name('categories');

        // Staff
        Route::get('/employees', fn () => view('admin.staff.employees'))->name('employees');
        Route::get('/activity-logs', fn () => view('admin.staff.logs'))->name('activity-logs');

        // Ads
        Route::get('/ads', fn () => view('admin.ads.index'))->name('all-ads');
        Route::get('/ads/create', fn () => view('admin.ads.create'))->name('create-ads');
        Route::get('/ads/pending', fn () => view('admin.ads.pending'))->name('pending-ads');
        Route::get('/ads/slots', fn () => view('admin.ads.slots'))->name('ad-slots-management');

        // Offers
        Route::get('/offers', fn () => view('admin.offers.index'))->name('all-offers');
        Route::get('/offers/create', fn () => view('admin.offers.create'))->name('create-offer');
        Route::get('/offers/scheduled', fn () => view('admin.offers.scheduled'))->name('scheduled-offers');

        // Rewards
        Route::get('/rewards/daily', fn () => view('admin.rewards.daily'))->name('daily-challenges');
        Route::get('/rewards/spin', fn () => view('admin.rewards.spin'))->name('spin-win');
        Route::get('/rewards/scratch', fn () => view('admin.rewards.scratch'))->name('scratch-cards');
        Route::get('/rewards/rules', fn () => view('admin.rewards.rules'))->name('reward-rules');

        // Wallet & Gifts
        Route::get('/gift-cards', fn () => view('admin.gifts.cards'))->name('gift-card-management');
        Route::get('/wallet', fn () => view('admin.wallet.transactions'))->name('wallet-transactions');
        Route::get('/redemptions', fn () => view('admin.wallet.redemptions'))->name('redemption-requests');

        // Information
        Route::get('/panchayath-notices', fn () => view('admin.info.notices'))->name('panchayath-notices');
        Route::get('/emergency-contacts', fn () => view('admin.info.contacts'))->name('emergency-contacts');
        Route::get('/local-announcements', fn () => view('admin.info.announcements'))->name('local-announcements');

        // Reports
        Route::get('/reports', fn () => view('admin.reports.index'))->name('reports');
        Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // Settings
        Route::get('/settings/general', fn () => view('admin.settings.general'))->name('general-settings');
        Route::get('/settings/app', fn () => view('admin.settings.app'))->name('app-configuration');
        Route::get('/settings/locality', fn () => view('admin.settings.locality'))->name('locality-setup');
        Route::get('/settings/notifications', fn () => view('admin.settings.notifications'))->name('notification-settings');
        Route::get('/pending-approvals', fn () => view('admin.approvals.pending'))->name('pending-approvals');
        // Profile
        Route::get('/profile', fn () => view('admin.profile.index'))->name('profile');
    });


/*
|--------------------------------------------------------------------------
| AREA OPERATOR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:area_operator'])
    ->prefix('area')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AreaOperator\DashboardController::class, 'index'])
            ->name('area.dashboard');
    });

/*
|--------------------------------------------------------------------------
| DEO
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:deo'])
    ->prefix('deo')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Deo\DashboardController::class, 'index'])
            ->name('deo.dashboard');
    });

/*
|--------------------------------------------------------------------------
| SALESMAN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:salesman'])
    ->prefix('salesman')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Salesman\DashboardController::class, 'index'])
            ->name('salesman.dashboard');
    });

/*
|--------------------------------------------------------------------------
| NORMAL USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])
            ->name('user.dashboard');
    });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze / Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
