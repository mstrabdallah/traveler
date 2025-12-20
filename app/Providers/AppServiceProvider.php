<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share('headerDestinations', \App\Models\Destination::where('is_active', true)->get());
        view()->share('headerCategories', \App\Models\TourCategory::where('is_active', true)->orderBy('sort_order')->get());
    }
}
