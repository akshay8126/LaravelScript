<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::controller(SignupController::class)->group(function () {
    Route::post('/register', 'register')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/login-post', 'LoginPost')->name('loginPost');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
});
