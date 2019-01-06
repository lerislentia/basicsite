<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SectionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\IBaseService',
            'App\Services\SectionService'
        );
    }
}
