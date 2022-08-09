<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ChargeRequestController;
use App\Http\Controllers\Admin\DepositRequestController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\RequestRechargeController;
use App\Http\Controllers\RequestDepositController;
use App\Http\Controllers\Admin\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [PageController::class, 'homepage'])->name('homepage');
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/recharge', [PageController::class, 'recharge']);
    Route::get('/payment', [PageController::class, 'payment']);
    Route::post('/payment', [RequestRechargeController::class, 'send']);
    Route::get('/confirm-recharge', [PageController::class, 'confirmRecharge']);
    Route::get('/deposit', [PageController::class, 'deposit']);
    Route::post('/deposit', [RequestDepositController::class, 'send']);
    Route::get('/recharge-history', [PageController::class, 'rechargeHistory']);
    Route::get('/deposit-history', [PageController::class, 'depositHistory']);
    Route::get('/myteam', [PageController::class, 'myteam'])->name('myteam');
    Route::get('/vip', [PageController::class, 'vip'])->name('vip');
    Route::get('/introduce', [PageController::class, 'introduce'])->name('introduce');
    Route::get('/station', [PageController::class, 'station'])->name('station');
    Route::get('/me', [PageController::class, 'me'])->name('me');
    Route::get('/agreement', [PageController::class, 'agreement'])->name('agreement');
    Route::get('/setting', [PageController::class, 'setting'])->name('setting');
    Route::get('/download', [PageController::class, 'download'])->name('download');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthenticationController::class, 'showRegisterForm']);
    Route::put('/register', [AuthenticationController::class, 'register']);
    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
    Route::put('/login', [AuthenticationController::class, 'login']);
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    Route::get('/', function () {
        return redirect('/admin/users');
    });
    Route::post('/send-notification', [NotificationController::class, 'send']);
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/getUserData', [UserController::class, 'getUserData']);
    Route::get('/users/{id}', [UserController::class, 'showEdit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::group(['prefix' => 'settings', 'middleware' => 'superadmin'], function () {
        Route::get('homepage-image', [SettingController::class, 'showSettingHomepageImage']);
        Route::put('homepage-image', [SettingController::class, 'saveSettingHomepageImage']);
        Route::get('CSKH', [SettingController::class, 'showCSKH']);
        Route::put('CSKH', [SettingController::class, 'saveCSKH']);
        Route::get('myteam', [SettingController::class, 'showSettingMyteam']);
        Route::put('myteam', [SettingController::class, 'saveSettingMyteam']);
        Route::get('vip', [SettingController::class, 'showSettingVip']);
        Route::put('vip', [SettingController::class, 'saveSettingVip']);
        Route::get('introduce', [SettingController::class, 'showSettingIntroduce']);
        Route::put('introduce', [SettingController::class, 'saveSettingIntroduce']);
        Route::get('download', [SettingController::class, 'showSettingDownload']);
        Route::put('download', [SettingController::class, 'saveSettingDownload']);
    });

    Route::get('/charge-requests', [ChargeRequestController::class, 'index'])->name('charge-requests');
    Route::get('/getChargeRequestData', [ChargeRequestController::class, 'getChargeRequestData']);
    Route::delete('/charge-requests/{id}', [ChargeRequestController::class, 'delete']);
    Route::put('/charge-requests/{id}', [ChargeRequestController::class, 'chargeProccess']);

    Route::get('/deposit-requests', [DepositRequestController::class, 'index'])->name('deposit-requests');
    Route::get('/getDepositRequestData', [DepositRequestController::class, 'getDepositRequestData']);
    Route::delete('/deposit-requests/{id}', [DepositRequestController::class, 'delete']);
    Route::put('/deposit-requests/{id}', [DepositRequestController::class, 'depositProccess']);

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/payments/create', [PaymentController::class, 'create']);
    Route::post('/payments', [PaymentController::class, 'save']);
    Route::get('/getPaymentData', [PaymentController::class, 'getPaymentData']);
    Route::delete('/payments/{id}', [PaymentController::class, 'delete']);
    Route::get('/payments/{id}', [PaymentController::class, 'showEdit']);
    Route::put('/payments/{id}', [PaymentController::class, 'update']);
});

