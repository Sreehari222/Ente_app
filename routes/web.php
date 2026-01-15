<?php

use App\Http\Controllers\Admin\AreaOperatorController;
use App\Http\Controllers\Admin\BlockedUserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AreaOperator\AreaoperatorDashboardController;
use App\Http\Controllers\deo\deoReportController;
use App\Http\Controllers\deo\deoVendorController;
use App\Http\Controllers\LoginController;
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

use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\CompanyMessageController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\AreaOperator\AreaOperatorAttendanceController;
use App\Http\Controllers\AreaOperator\AreaOperatorDEOController;
use App\Http\Controllers\AreaOperator\AreaOperatorMessageController;
use App\Http\Controllers\AreaOperator\AreaOperatorNotificationController;
use App\Http\Controllers\AreaOperator\AreaOperatorProfileController;
use App\Http\Controllers\AreaOperator\AreaOperatorReportController;
use App\Http\Controllers\AreaOperator\AreaOperatorSalesmanController;
use App\Http\Controllers\AreaOperator\AreaOperatorSubmissionController;
use App\Http\Controllers\AreaOperator\AreaOperatorTaskController;
use App\Http\Controllers\AreaOperator\AreaOperatorVendorController;
use App\Http\Controllers\deo\DeoProfileController;
use App\Http\Controllers\Deo\SalesmanlistController;
use App\Http\Controllers\EMIController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\salesman\RecommendationController;
use App\Http\Controllers\Salesman\StatisticsController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserCompanyMessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return view('auth.login');
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
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/shop-owners', [DashboardController::class, 'shopUsers'])->name('shop-owners');

        // ================= AREA OPERATORS =================
        Route::get('/area-operators', [AreaOperatorController::class, 'index'])->name('area-operators');
        Route::get('/area-operators/{id}', [AreaOperatorController::class, 'show'])->name('area-operators.show');
        Route::get('/area-operators/{id}/edit', [AreaOperatorController::class, 'edit'])->name('area-operators.edit');
        Route::delete('/area-operators/{id}', [AreaOperatorController::class, 'destroy'])->name('area-operators.destroy');

        // ================= DEOs =================
        Route::get('/deos', [DeoController::class, 'index'])->name('deos');
        Route::get('/deos/{deo}', [DeoController::class, 'show'])->name('deos.show');
        Route::get('/deos/{deo}/edit', [DeoController::class, 'edit'])->name('deos.edit');
        Route::put('/admin/deos/{id}', [DeoController::class, 'update'])->name('deos.update');
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
        Route::get('/settings/app', [SettingsController::class, 'appConfig'])->name('settings.app');
        Route::get('/settings/locality', [SettingsController::class, 'locality'])->name('settings.locality');
        Route::get('/settings/notifications', [SettingsController::class, 'notifications'])->name('settings.notifications');
        Route::post('/save', [SettingsController::class, 'store'])->name('store');
        // Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::post('/admin/submissions', [ProfileController::class, 'submissions'])->name('submissions.submissions');
        Route::delete('/admin/submissions/{submission}', [ProfileController::class, 'removesubmissions'])->name('submissions.destroy');


        // Notices
        Route::get('notices', [InfoController::class, 'notices'])->name('notices.index');
        Route::post('notices', [InfoController::class, 'storeNotice'])->name('notices.store');
        Route::get('notices/{id}/edit', [InfoController::class, 'editNotice'])->name('notices.edit');
        Route::put('notices/{id}', [InfoController::class, 'updateNotice'])->name('notices.update');
        Route::delete('notices/{id}', [InfoController::class, 'destroyNotice'])->name('notices.destroy');

        // Emergency Contacts
        Route::get('contacts', [InfoController::class, 'contacts'])->name('contacts.index');
        Route::post('contacts', [InfoController::class, 'storeContact'])->name('contacts.store');
        Route::get('contacts/{id}/edit', [InfoController::class, 'editContact'])->name('contacts.edit');
        Route::put('contacts/{id}', [InfoController::class, 'updateContact'])->name('contacts.update');
        Route::delete('contacts/{id}', [InfoController::class, 'destroyContact'])->name('contacts.destroy');

        // Announcements
        Route::get('announcements', [InfoController::class, 'announcements'])->name('announcements.index');
        Route::post('announcements', [InfoController::class, 'storeAnnouncement'])->name('announcements.store');
        Route::get('announcements/{id}/edit', [InfoController::class, 'editAnnouncement'])->name('announcements.edit');
        Route::put('announcements/{id}', [InfoController::class, 'updateAnnouncement'])->name('announcements.update');
        Route::delete('announcements/{id}', [InfoController::class, 'destroyAnnouncement'])->name('announcements.destroy');

        Route::get('company/messages', [CompanyMessageController::class, 'index'])->name('company.messages.index');
        Route::post('company/messages', [CompanyMessageController::class, 'store'])->name('company.messages.store');
        Route::delete('company/messages/{id}', [CompanyMessageController::class, 'destroy'])->name('company.messages.destroy');

        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        // Logout
        Route::post('/logout', action: [ProfileController::class, 'logout'])->name('logout');
        Route::get('/vendors/{vendor}', [VendorController::class, 'view'])->name('vendors.show');
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

        Route::get('/dashboard', [AreaoperatorDashboardController::class, 'dashboard'])->name('area.dashboard');
        // DEO
        Route::get('/deo', [AreaOperatorDEOController::class, 'index'])->name('area.deo.index');
        Route::get('/deo/{deo}', [AreaOperatorDEOController::class, 'show'])->name('area.deo.show');
        Route::get('/deo/create', [AreaOperatorDEOController::class, 'create'])->name('area.deo.create');
        Route::post('/deo/store', [AreaOperatorDEOController::class, 'store'])->name('area.deo.store');
        Route::get('/deo/{id}/edit', [AreaOperatorDEOController::class, 'edit'])->name('area.deo.edit');
        Route::put('/deo/{id}', [AreaOperatorDEOController::class, 'update'])->name('area.deo.update');
        Route::delete('/deo/{id}', [AreaOperatorDEOController::class, 'destroy'])->name('area.deo.destroy');


        Route::get('/salesmen', [AreaOperatorSalesmanController::class, 'index'])->name('area.salesmen.index');
        Route::get('/create', [AreaOperatorSalesmanController::class, 'create'])->name('create');
        Route::get('/salesmen/{salesman}', [AreaOperatorSalesmanController::class, 'show'])->name('area.salesmen.show');
        Route::post('/store', [AreaOperatorSalesmanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AreaOperatorSalesmanController::class, 'edit'])->name('area.salesmen.edit');
        Route::put('/{id}', [AreaOperatorSalesmanController::class, 'update'])->name('area.salesmen.update');
        Route::delete('/{id}', [AreaOperatorSalesmanController::class, 'destroy'])->name('destroy');

        Route::get('/vendors', [AreaOperatorVendorController::class, 'index'])->name('area.vendors.index');
        Route::get('/vendors/{vendor}', [AreaOperatorVendorController::class, 'show'])->name('area.vendors.show');
        Route::get('/vendors/{vendor}/edit', [AreaOperatorVendorController::class, 'edit'])->name('area.vendors.edit');
        Route::put('/vendors/{vendor}', [AreaOperatorVendorController::class, 'update'])->name('area.vendors.update');
        Route::delete('/vendors/{vendor}', [AreaOperatorVendorController::class, 'destroy'])->name('area.vendors.destroy');



        Route::get('/submissions', [AreaOperatorSubmissionController::class, 'index'])->name('area.submissions.index');


        Route::get('/reports', [AreaOperatorReportController::class, 'index'])->name('area.reports.index');

        Route::get('/attendance', [AreaOperatorAttendanceController::class, 'index'])->name('area.attendance.index');

        Route::get('/tasks', [AreaOperatorTaskController::class, 'index'])->name('area.tasks.index');

        Route::get('/notifications', [AreaOperatorNotificationController::class, 'index'])->name('area.notifications.index');

    });
Route::middleware(['auth', 'role:area_operator'])
    ->prefix('area')
    ->group(function () {
        Route::get('profile', [AreaOperatorProfileController::class, 'index'])
            ->name('area.profile.index');Route::put('profile/{user}', [AreaOperatorProfileController::class, 'update'])
    ->name('area.profile.update');

    });







Route::get('submissions', [SubmissionController::class, 'index'])->name('area.submissions.index');
Route::post('submissions', [SubmissionController::class, 'store'])->name('area_operator.submissions.store');


Route::middleware(['auth'])->group(function () {

    Route::get('/emis', [EMIController::class, 'index'])->name('emis.index');

    Route::get('/emis/{payment}', [EMIController::class, 'show'])
        ->name('emis.show');
        Route::post('/emis/{installment}/pay', [EMIController::class, 'markPaid'])
    ->name('emis.pay');


});

/*
|--------------------------------------------------------------------------
| DEO
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:deo'])
    ->prefix('deo')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Deo\DashboardController::class, 'index'])->name('deo.dashboard');
        Route::get('/salesmen', [SalesmanlistController::class, 'index'])->name('salesmen.index');
        Route::get('/deo/salesmen/{salesman}', [SalesmanlistController::class, 'show'])->name('salesmen.show');
        Route::get('/salesmen/{salesman}/edit', [SalesmanlistController::class, 'edit'])->name('salesmen.edit');
        Route::put('salesmen/{id}', [SalesmanController::class, 'update'])->name('salesman.update');
        Route::delete('/salesmen/{salesman}', [SalesmanlistController::class, 'destroy'])->name('salesmen.destroy');
        Route::get('/salesmen/performance', [SalesmanController::class, 'performance'])->name('deo.salesmen.performance');
        Route::get('deo/vendors/pending', [deoVendorController::class, 'pending'])->name('deo.vendors.pending');

        Route::get('reports/monthly', [deoReportController::class, 'monthly'])->name('reports.monthly');


        Route::get('vendors/{vendor}', [deoVendorController::class, 'show'])->name('deo.vendors.show');
        Route::get('vendors/{vendor}/edit', [deoVendorController::class, 'edit'])->name('deo.vendors.edit');
        Route::put('vendors/{vendor}', [deoVendorController::class, 'update'])->name('deo.vendors.update');

        Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
        Route::get('/vendors/pending', [VendorController::class, 'pending'])->name('vendors.pending');
        Route::put('vendors/{vendor}/approve', [VendorController::class, 'approve'])->name('vendors.approve');


        Route::get('deo/profile', [DeoProfileController::class, 'index'])->name('deo.profile');
        Route::get('profile/edit', [DeoProfileController::class, 'edit'])->name('profile.edit');
        Route::put('deo/profile', [DeoProfileController::class, 'update'])->name('profile.update');
        // Route::get('/reports/daily', [DeoReportController::class, 'daily'])->name('reports.daily');
        // Route::get('/reports/monthly', [DeoReportController::class, 'monthly'])->name('reports.monthly');


        // Route::get('/profile', [DeoProfileController::class, 'show'])->name('profile');
        Route::get('submissions', [SubmissionController::class, 'index'])->name('deo.submissions.index');
        Route::post('submissions', [SubmissionController::class, 'store'])->name('deo.submissions.store');
        Route::get('deo/vendors', [VendorController::class, 'deoindex'])->name('vendors.deoindex');
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
        Route::get('/vendors/{id}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
        Route::put('/salesman/vendors/{vendor}', [VendorController::class, 'update'])->name('vendors.update');
        Route::delete('salesman/vendors/{id}', [VendorController::class, 'destroy'])->name('vendors.destroy');


        Route::get('sales/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
        Route::patch('vendors/{vendor}/toggle', [VendorController::class, 'toggleStatus'])->name('vendors.toggle');
        Route::get('statistics', [StatisticsController::class, 'index'])->name('statistics');        // Route::post('/recommendations', [RecommendationController::class, 'store'])->name('recommendations.store');
        Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
        Route::post('submissions', [SubmissionController::class, 'store'])->name('submissions.store');

        Route::get('admin/salesmen/performance', [SalesmanController::class, 'performance']);
    });


/*
|--------------------------------------------------------------------------
| NORMAL USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    });

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
        Route::post('messages', [MessageController::class, 'store'])->name('messages.store'); // NEW
        Route::post('messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    });


    Route::prefix('deo')->middleware('role:deo')->name('deo.')->group(function () {
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
        Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
        Route::post('messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    });

    Route::prefix('salesman')->middleware('role:salesman')->name('salesman.')->group(function () {
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
        Route::post('messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    });

    Route::prefix('area-operator')->middleware('role:area_operator')->name('area_operator.')->group(function () {
        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
        Route::post('messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    });
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
    Route::post('messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
});

Route::prefix('salesman')->middleware(['auth', 'role:salesman'])->group(function () {
    Route::get('company/messages', [UserCompanyMessageController::class, 'index'])->name('salesman.company.messages.index');
});

Route::prefix('deo')->middleware(['auth', 'role:deo'])->group(function () {
    Route::get('company/messages', [UserCompanyMessageController::class, 'index'])->name('deo.company.messages.index');
});

Route::prefix('area-operator')->middleware(['auth', 'role:area_operator'])->group(function () {
    Route::get('company/messages', [UserCompanyMessageController::class, 'index'])->name('area_operator.company.messages.index');
});


Route::middleware('auth')->group(function () {

    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    Route::get('deos/{deo}/salesmen', [TaskController::class, 'getSalesmenByDEO']);
});




require __DIR__ . '/auth.php';
