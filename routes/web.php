<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Frontend\Dashboard\Index;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/auth', Login::class)->name('login');
    route::get('/register', Register::class)->name('register');
});
Route::get('/', Index::class)->name('user.dashboard');