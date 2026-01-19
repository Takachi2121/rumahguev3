<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
})->name('rumahgue');

Route::prefix('login')->group(function (){
    Route::get('/', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/verify', [AuthController::class, 'login'])->name('verify');
    Route::post('/request-otp', [AuthController::class, 'requestOTP'])->name('request-otp');
    Route::post('/verify-otp', [AuthController::class, 'verifyRegister'])->name('verify-otp');
    Route::get('/auth/google', [SocialController::class, 'redirect'])->name('redirect');
    Route::get('/auth/google/callback', [SocialController::class, 'callback'])->name('callback');
    });
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
