<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ChargeRequestController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\RequestRechargeController;
use App\Http\Controllers\RequestDepositController;

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
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/getUserData', [UserController::class, 'getUserData']);
    Route::get('/users/{id}', [UserController::class, 'showEdit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::group(['prefix' => 'settings'], function () {
        Route::get('homepage-image', [SettingController::class, 'showSettingHomepageImage']);
        Route::put('homepage-image', [SettingController::class, 'saveSettingHomepageImage']);
        Route::get('CSKH', [SettingController::class, 'showCSKH']);
        Route::put('CSKH', [SettingController::class, 'saveCSKH']);
    });

    Route::get('/charge-requests', [ChargeRequestController::class, 'index']);
    Route::get('/getChargeRequestData', [ChargeRequestController::class, 'getChargeRequestData']);

    Route::get('/payments', [PaymentController::class, 'index']);
    Route::get('/payments/create', [PaymentController::class, 'create']);
    Route::post('/payments', [PaymentController::class, 'save']);
    Route::get('/getPaymentData', [PaymentController::class, 'getPaymentData']);
    Route::delete('/payments/{id}', [PaymentController::class, 'delete']);
    Route::get('/payments/{id}', [PaymentController::class, 'showEdit']);
    Route::put('/payments/{id}', [PaymentController::class, 'update']);
});

