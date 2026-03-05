<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::define('admin', function () {
            return auth()->user()->role === 'admin';
        });

        Gate::define('rh', function () {
            return auth()->user()->role === 'rh';
        });

        Gate::define('colaborator', function () {
            return auth()->user()->role === 'colaborator';
        });
    }
}
