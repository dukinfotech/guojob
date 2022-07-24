<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;

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
    Route::get('/users', [UserController::class, 'list']);
    Route::group(['prefix' => 'settings'], function () {
        Route::get('homepage-image', [SettingController::class, 'showSettingHomepageImage']);
        Route::put('homepage-image', [SettingController::class, 'saveSettingHomepageImage']);
        Route::get('CSKH', [SettingController::class, 'showCSKH']);
        Route::put('CSKH', [SettingController::class, 'saveCSKH']);
    });
});

