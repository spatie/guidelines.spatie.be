<?php

namespace App\Navigation;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Support\ServiceProvider;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->when(Navigation::class)
            ->needs(Filesystem::class)
            ->give(function () {
                return $this->app->make(FilesystemManager::class)->disk('content');
            });

        $this->app->singleton('navigation', Navigation::class);
    }
}
