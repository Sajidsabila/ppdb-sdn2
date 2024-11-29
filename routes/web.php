<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Backend\Admin\Aboutus\AboutComponent;
use App\Livewire\Backend\Admin\Configuration\ConfigurationComponent;
use App\Livewire\Backend\Admin\Dashboard\DashboardAdminComponent;
use App\Livewire\Backend\Admin\Gallery\GalleryComponent;
use App\Livewire\Backend\Admin\Teacher\TeacherComponent;
use App\Livewire\Backend\Admin\User\UserComponent;
use App\Livewire\Frontend\Dashboard\Index;
use App\Livewire\Partials\Dashboard\Navbar;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/auth', Login::class)->name('login');
    Route::get('/admin/auth', [AuthController::class, 'index'])->name('admin.login');
    Route::post('/admin/auth/credential', [AuthController::class, 'auth'])->name('auth.admin');
    route::get('/register', Register::class)->name('register');
});
Route::group([
    'middleware' => ['auth', 'role:admin'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/', DashboardAdminComponent::class)->name('home');
    Route::get('/gallery', GalleryComponent::class)->name('gallery');
    Route::get('/teacher', TeacherComponent::class)->name('teacher');
    Route::get('/about', AboutComponent::class)->name('about');
    Route::get('/user', UserComponent::class)->name('user');
    Route::get('/configuration', ConfigurationComponent::class)->name('configuration');
    Route::get('/logout', [Navbar::class, 'logout'])->name('logout');

});
Route::group([
    'middleware' => ['guest'],
    ['auth', 'role:user'],
], function () {
    Route::get('/', Index::class)->name('user.dashboard');
});
