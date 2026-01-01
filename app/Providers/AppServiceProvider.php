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
        view()->composer('*', function ($view) {
            $view->with([
                'headerDestinations' => \App\Models\Destination::where('is_active', true)->get(),
                'headerCategories' => \App\Models\TourCategory::where('is_active', true)->orderBy('sort_order')->get(),
            ]);
        });
    }
}
