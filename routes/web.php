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
use App\Http\Controllers\RegisterController\UserRegisterController;
use App\Http\Controllers\Salesman\VendorController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\RewardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('register/area-operator', [UserRegisterController::class,'createAreaOperator'])->name('admin.area-operators.create');
Route::post('register/area-operator', [UserRegisterController::class,'storeAreaOperator'])->name('admin.area-operators.store');

Route::get('register/deo', [UserRegisterController::class,'createDEO'])->name('admin.deos.create');
Route::post('register/deo', [UserRegisterController::class,'storeDEO'])->name('admin.deos.store');

Route::get('register/salesman', [UserRegisterController::class,'createSalesman'])->name('admin.salesmen.create');
Route::post('register/salesman', [UserRegisterController::class,'storeSalesman'])->name('admin.salesmen.store');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/area-operators', [AreaOperatorController::class, 'index'])->name('area-operators');
        Route::get('/admin/area-operators/{id}', [AreaOperatorController::class, 'show'])->name('area-operators.show');
        Route::get('/admin/area-operators/{id}/edit', [AreaOperatorController::class, 'edit'])->name('area-operators.edit');
        Route::delete('/admin/area-operators/{id}', [AreaOperatorController::class, 'destroy'])->name('area-operators.destroy');


        Route::get('/deos', [DeoController::class, 'index'])->name('deos');
        Route::get('deos/{deo}', [DeoController::class, 'show'])->name('deos.show');
        Route::get('deos/{deo}/edit', [DeoController::class, 'edit'])->name('deos.edit');
        Route::delete('deos/{deo}', [DeoController::class, 'destroy'])->name('deos.destroy');

        Route::get('/salesmen', [SalesmanController::class, 'index'])->name('salesmen');
        Route::get('salesmen/{salesman}/edit', [salesmanController::class,'edit'])->name('salesmen.edit');
        Route::put('salesmen/{salesman}', [SalesmanController::class,'update'])->name('salesmen.update');
        Route::delete('salesmen/{salesman}', [SalesmanController::class,'destroy'])->name('salesmen.destroy');

        Route::get('/categories', [SubCategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [SubCategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [SubCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [SubCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [SubCategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
        Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
        Route::get('/plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('/plans/{plan}', [PlanController::class, 'update'])->name('plans.update');
        Route::delete('/plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy');

        //advertinements
        Route::get('/ads', [AdvertisementController::class, 'allAds'])->name('all-ads');
       // Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('create-ads');
        Route::get('/ads/create', [AdvertisementController::class, 'create'])->name('create-ads');
        Route::post('/ads/store', [AdvertisementController::class, 'store'])->name('ads.store');
        Route::get('/admin/ads/{id}/edit', [AdvertisementController::class, 'edit'])->name('admin.ads.edit');
        Route::delete('/admin/ads/{id}', [AdvertisementController::class, 'destroy'])->name('admin.ads.destroy');
        Route::put('/admin/ads/{id}', [AdvertisementController::class, 'update'])->name('admin.ads.update');

        // Offers
        Route::get('/offers', [OfferController::class, 'alloffer'])->name('all-offers');
        Route::get('/offers/create', [OfferController::class, 'create'])->name('create-offer');
        Route::post('/offers/store', [OfferController::class, 'store'])->name('offers.store');
        Route::delete('/offers/{offer}', [OfferController::class, 'destroy'])->name('offers.destroy');
        Route::get('/offers/scheduled', [OfferController::class, 'scheduledOffers'])->name('scheduled-offers');

        //reward management
        Route::get('/daily-challenges', [RewardController::class, 'dailyChallenges'])->name('daily-challenges');
        Route::get('/daily-challenges/create', [RewardController::class, 'createDailyChallenge'])->name('daily_challenges.create');
        Route::post('/daily-challenges/store', [RewardController::class, 'storeDailyChallenge'])->name('daily_challenge.store');
        Route::delete('/daily-challenges/{id}', [RewardController::class, 'deleteDailyChallenge'])->name('daily_challenges.delete');
        /*
        |--------------------------------------------------------------------------
        | VERIFICATION & BLOCKING
        |--------------------------------------------------------------------------
        */
       Route::get('/vendor-verifications', [VerificationController::class, 'vendors'])->name('vendor-verifications');

       Route::post('/vendor-verifications/{id}/approve', [VerificationController::class, 'approve'])->name('vendor-verifications.approve');
       Route::delete('/vendor-verifications/{id}/reject', [VerificationController::class, 'reject'])->name('vendor-verifications.reject');
       Route::get('/blocked-users', [BlockedUserController::class, 'index'])->name('blocked-users');
       Route::patch('/blocked-users/{id}/unblock', [BlockedUserController::class, 'unblock'])->name('blocked-users.unblock');
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
require __DIR__ . '/auth.php';
