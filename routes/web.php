<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Frontend\Dashboard\Index;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/auth', Login::class)->name('login');
    Route::get('/admin/auth', [AuthController::class, 'index'])->name('admin.login');
    Route::post('/admin/auth/credential', [AuthController::class, 'auth'])->name('auth.admin');
    route::get('/register', Register::class)->name('register');
});

Route::get('/admin', Index::class)->name('admin');
Route::get('/', Index::class)->name('user.dashboard');