<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Image;
use App\Observers\ImageObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // You can register any custom services or bindings here
        // For example, binding an interface to a class
        // $this->app->bind(SomeInterface::class, SomeImplementation::class);

        // Registering an observer
        Image::observe(ImageObserver::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Handling database schema length issue for older MySQL versions
        // This ensures compatibility for databases with lower character set limits (like utf8mb4)
        Schema::defaultStringLength(191);

        // Share data with all views, e.g., sharing common variables globally
        View::share('appName', config('app.name'));

        // Perform additional bootstrapping logic if needed
    }
}