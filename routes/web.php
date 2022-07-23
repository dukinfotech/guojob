<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\UserController;

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
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthenticationController::class, 'showRegisterForm']);
    Route::put('/register', [AuthenticationController::class, 'register']);
    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
    Route::put('/login', [AuthenticationController::class, 'login']);
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'list']);
});

