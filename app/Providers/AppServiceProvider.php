<?php

namespace App\Providers;

use App\Services\StudentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // Menyimpan StudentService sebagai singleton
        $this->app->singleton(StudentService::class, function ($app) {
            return new StudentService();
        });
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
