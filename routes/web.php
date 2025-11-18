<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\AuthAdmin;
use App\Livewire\Backend\Admin\Ppdb\StudentRankComponent;
use App\Livewire\Frontend\EditForm;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ForgotPassword;
use Illuminate\Support\Facades\Route;
use App\Livewire\Frontend\DetailAbout;
use App\Livewire\Frontend\ProfileUser;
use App\Livewire\Frontend\RegisterForm;
use App\Http\Controllers\AuthController;
use App\Livewire\Frontend\DetailGallery;
use App\Livewire\Frontend\DetailTeacher;
use App\Livewire\Frontend\Dashboard\Index;
use App\Livewire\Backend\Admin\Ppdb\Detail;
use App\Livewire\Partials\Dashboard\Navbar;
use App\Livewire\Frontend\DetailRegistration;
use App\Livewire\Backend\Admin\Ppdb\ListComponent;
use App\Livewire\Backend\Admin\User\UserComponent;
use App\Livewire\Backend\Profile\ProfileComponent;
use App\Livewire\Backend\Admin\Ppdb\TableComponent;
use App\Livewire\Backend\Admin\Ppdb\DetailComponent;
use App\Livewire\Backend\Admin\Ppdb\StudentAccepted;
use App\Livewire\Backend\Admin\Ppdb\RegistrationForm;
use App\Livewire\Backend\Admin\Ppdb\TabelPendaftaran;
use App\Livewire\Backend\Admin\Aboutus\AboutComponent;
use App\Livewire\Backend\Admin\Gallery\GalleryComponent;
use App\Livewire\Backend\Admin\Teacher\TeacherComponent;
use App\Livewire\Backend\Admin\Dashboard\DashboardAdminComponent;
use App\Livewire\Backend\Admin\Academicyear\AcademicYearComponent;
use App\Livewire\Backend\Admin\Configuration\ConfigurationComponent;

Route::get('/', Index::class)->name('home');
Route::get('/home', function () {
    return redirect('/');
});

Route::middleware('guest')->group(function () {
    Route::get('/auth', Login::class)->name('login');
    Route::get('/admin/auth', AuthAdmin::class)->name('admin.login');
    Route::post('/admin/auth/credential', [AuthController::class, 'auth'])->name('auth.admin');
    route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
    ROute::get('/reset-password/{token}', ResetPassword::class)->name('reset-password');
    Route::get('/verification-email/{token}', [Register::class, 'verification'])->name('verification');
    Route::get('/about', DetailAbout::class)->name('about');
    Route::get('/gallery', DetailGallery::class)->name('gallery');
    Route::get('/teacher', DetailTeacher::class)->name('teacher');
    Route::get('/pengumuman-ppdb', \App\Livewire\Frontend\PengumumanComponent::class)->name('pengumuman');
});
Route::group([
    'middleware' => ['auth', 'role:user'],
    'prefix' => '/',
    'as' => 'user.'
], function () {
    Route::get('/ppdb', RegisterForm::class)->name('ppdb');
    Route::get('/ppdb/edit/{studentId}', EditForm::class)->name('edit');
    Route::get('/logout', [\App\Livewire\Partials\Frontend\Navbar::class, 'logout'])->name('logout');
    Route::get('/profile', ProfileUser::class)->name('profile');
    Route::get("/detail-ppdb", DetailRegistration::class)->name('detail');
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
    Route::get('/academic-year', AcademicYearComponent::class)->name('academic');
    Route::get('/configuration', ConfigurationComponent::class)->name('configuration');
    Route::get('/logout', [Navbar::class, 'logout'])->name('logout');
    Route::get('/profile', ProfileComponent::class)->name('profile');
    Route::get('/form-pendaftaran/{studentId?}', RegistrationForm::class)->name('form');
    Route::get('/detail-pendaftar/{studentId}', DetailComponent::class)->name('detail');
    Route::get('/pendaftar', ListComponent::class)->name('ppdb');
    Route::get('/generate-pdf/{id}', [ListComponent::class, 'generatePdf'])->name('generate-pdf');
    Route::get('/diterima', StudentAccepted::class)->name('ppdb-acepted');
    Route::get("/student-rank", StudentRankComponent::class)->name('student-rank');
});

Route::group([
    'middleware' => ['auth', 'role:operator'],
    'prefix' => 'operator',
    'as' => 'operator.'
], function () {
    Route::get('/', DashboardAdminComponent::class)->name('home');
    Route::get('/form-pendaftaran/{studentId?}', RegistrationForm::class)->name('form');
    Route::get('/detail-pendaftar/{studentId}', DetailComponent::class)->name('detail');
    Route::get('/pendaftar', ListComponent::class)->name('ppdb');
    Route::get('/logout', [Navbar::class, 'logout'])->name('logout');
    Route::get('/generate-pdf/{id}', [ListComponent::class, 'generatePdf'])->name('generate-pdf');
    Route::get('/diterima', StudentAccepted::class)->name('ppdb-acepted');
    Route::get('/profile', ProfileComponent::class)->name('profile');
});

