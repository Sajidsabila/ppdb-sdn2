<?php

namespace App\Providers;

use App\Models\Configuration;
use App\Services\StudentService;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        $configurations = Configuration::first();
        view()->share(
            [
                "configurations" => $configurations
            ]
        );
    }
}
