<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function (){
    Route::get('/', [PageController::class, 'beranda'])->name('rumahgue');
    Route::get('/jasa-kami', [PageController::class, 'jasa'])->name('jasa');
    Route::get('/jasa-kami/{id}', [PageController::class, 'jasaDetail'])->name('jasa-detail');
});
Route::get('/pengaturan', [PageController::class, 'mitraSettings'])->name('mitra-settings');

Route::prefix('mitra')->group(function(){
    Route::get('/', [PageController::class, 'mitraHome'])->name('mitra-home');
    Route::post('/change-password', [MitraController::class, 'changePassword'])->name('mitra-change-password');
    Route::post('/new-password', [MitraController::class, 'newPassword'])->name('mitra-new-password');
    Route::put('/update-profile', [MitraController::class, 'updateMitra'])->name('mitra-update-profile');
    Route::get('/portofolio', [PageController::class, 'mitraPortfolio'])->name('mitra-portfolio');
    Route::post('/add-portofolio', [MitraController::class, 'add'])->name('mitra-add-portfolio');
    Route::put('/edit-portofolio', [MitraController::class, 'edit'])->name('mitra-edit-portfolio');
    Route::delete('/delete-portofolio', [MitraController::class, 'delete'])->name('mitra-delete-portfolio');
});

Route::prefix('admin')->group(function(){
    Route::get('/', [PageController::class, 'adminUser'])->name('admin-user');
    Route::put('/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin-edit-user');
});

Route::prefix('login')->group(function (){
    Route::get('/', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/verify', [AuthController::class, 'login'])->name('verify');
    Route::post('/request-otp', [AuthController::class, 'requestOTP'])->name('request-otp');
    Route::post('/verify-otp', [AuthController::class, 'verifyRegister'])->name('verify-otp');
    Route::get('/auth/google', [SocialController::class, 'redirect'])->name('redirect');
    Route::get('/auth/google/callback', [SocialController::class, 'callback'])->name('callback');
    });
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
