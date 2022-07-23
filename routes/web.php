<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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

Route::get('/', function () {
    return view('welcome');
})->name('homepage');


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthenticationController::class, 'showRegisterForm']);
    Route::put('/register', [AuthenticationController::class, 'register']);
    Route::get('/login', [AuthenticationController::class, 'showLoginForm']);
    Route::put('/login', [AuthenticationController::class, 'login']);
});

