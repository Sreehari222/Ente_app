<?php

use App\Http\Controllers\Admin\AreaOperatorController;
use App\Http\Controllers\Admin\BlockedUserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeoController;
use App\Http\Controllers\Admin\SalesmanController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController\UserRegisterController;
use App\Http\Controllers\Salesman\VendorController;
use App\Http\Controllers\SettingsController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('register/area-operator', [UserRegisterController::class, 'createAreaOperator'])->name('admin.area-operators.create');
Route::post('register/area-operator', [UserRegisterController::class, 'storeAreaOperator'])->name('admin.area-operators.store');

Route::get('register/deo', [UserRegisterController::class, 'createDEO'])->name('admin.deos.create');
Route::post('register/deo', [UserRegisterController::class, 'storeDEO'])->name('admin.deos.store');

Route::get('register/salesman', [UserRegisterController::class, 'createSalesman'])->name('admin.salesmen.create');
Route::post('register/salesman', [UserRegisterController::class, 'storeSalesman'])->name('admin.salesmen.store');



Route::middleware(['auth'])->group(function () {
    Route::get('/get-sub-categories/{parentId}', function ($parentId) {
        return Category::where('parent_id', $parentId)->orderBy('name')->get();
    })->name('get-sub-categories');
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

        // ================= DASHBOARD & USERS =================
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users');

        // ================= AREA OPERATORS =================
        Route::get('/area-operators', [AreaOperatorController::class, 'index'])->name('area-operators');
        Route::get('/area-operators/{id}', [AreaOperatorController::class, 'show'])->name('area-operators.show');
        Route::get('/area-operators/{id}/edit', [AreaOperatorController::class, 'edit'])->name('area-operators.edit');
        Route::delete('/area-operators/{id}', [AreaOperatorController::class, 'destroy'])->name('area-operators.destroy');

        // ================= DEOs =================
        Route::get('/deos', [DeoController::class, 'index'])->name('deos');
        Route::get('/deos/{deo}', [DeoController::class, 'show'])->name('deos.show');
        Route::get('/deos/{deo}/edit', [DeoController::class, 'edit'])->name('deos.edit');
        Route::delete('/deos/{deo}', [DeoController::class, 'destroy'])->name('deos.destroy');

        // ================= SALESMEN =================
        Route::get('/salesmen', [SalesmanController::class, 'index'])->name('salesmen');
        Route::get('/salesmen/{salesman}/edit', [SalesmanController::class, 'edit'])->name('salesmen.edit');
        Route::put('/salesmen/{salesman}', [SalesmanController::class, 'update'])->name('salesmen.update');
        Route::delete('/salesmen/{salesman}', [SalesmanController::class, 'destroy'])->name('salesmen.destroy');

        // ================= CATEGORIES =================
        Route::get('/categories', [SubCategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [SubCategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [SubCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [SubCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [SubCategoryController::class, 'destroy'])->name('categories.destroy');

        // ================= PLANS =================
        Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
        Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
        Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
        Route::delete('/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');

        /*
        |--------------------------------------------------------------------------
        | VERIFICATION & BLOCKING
        |--------------------------------------------------------------------------
        */

        // 🔍 Vendor Verification Requests - LIST
        Route::get('/verification-requests', [VerificationController::class, 'index'])->name('verification.index');
        Route::get('/verification-requests/{id}', [VerificationController::class, 'show'])->name('verification.show');
        Route::post('/verification-requests/{id}/approve', [VerificationController::class, 'approve'])->name('verification.approve');
        Route::delete('/verification-requests/{id}/reject', [VerificationController::class, 'reject'])->name('verification.reject');
        Route::get('/blocked-users', [BlockedUserController::class, 'index'])->name('blocked-users.index');
        Route::get('/blocked-users/{vendor}', [BlockedUserController::class, 'show'])->name('blocked-users.show');
        Route::post('/blocked-users/{id}/approve', [BlockedUserController::class, 'approve'])->name('blocked-users.approve');


        Route::get('/settings/general', [SettingsController::class, 'general'])->name('settings.general');
        Route::post('/admin/settings/general', [SettingsController::class, 'store'])->name('settings.general.store');
        Route::get('/settings/app', [SettingsController::class, 'app'])->name('settings.app');
        Route::get('/settings/locality', [SettingsController::class, 'locality'])->name('settings.locality');
        Route::get('/settings/notifications', [SettingsController::class, 'notifications'])->name('settings.notifications');

        // Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

        // Logout
        Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
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
    ->name('salesman.')->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\Salesman\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/add-vendor', [VendorController::class, 'create'])->name('add-vendor');
        Route::get('/vendor-list', [VendorController::class, 'index'])->name('vendor-list');
        Route::post('sales/vendors/store', [VendorController::class, 'store'])->name('vendors.store');
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


Route::middleware('auth')->group(function () {

    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    Route::get('/messages', function () {
        return view('messages.index');
    })->name('messages.index');

    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze / Fortify)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
