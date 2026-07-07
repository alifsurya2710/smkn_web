<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SchoolProfile;

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
        \Illuminate\Support\Facades\View::composer(['school.*', 'layouts.landing'], function ($view) {
            $view->with('profile', \App\Models\SchoolProfile::first());
        });
    }
}
