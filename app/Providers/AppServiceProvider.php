<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        // Register the admin components with its full path since they got moved to the admin folder
        Blade::component('admin.components.auth.auth-layout', 'admin-auth-layout');
        Blade::component('admin.components.admin-footer', 'admin-footer');
        Blade::component('admin.components.admin-header', 'admin-header');
        Blade::component('admin.components.admin-layout', 'admin-layout');
        Blade::component('admin.components.admin-page-title', 'admin-page-title');
        Blade::component('admin.components.admin-sidebar', 'admin-sidebar');
    }
}
