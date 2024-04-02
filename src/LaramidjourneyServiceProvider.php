<?php

namespace Arthmelikyan\Laramidjourney;

use Illuminate\Support\ServiceProvider;

class LaramidjourneyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
            require_once __DIR__ . '/../vendor/autoload.php';
        }

        if ($this->app->runningInConsole()) {
            $this->registerPublishes();
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laramidjourney.php', 'laramidjourney');

        $this->app->singleton('laramidjourney', function () {
            return new LaraMidjourney;
        });
    }

    protected function registerPublishes(): void
    {
        $this->publishes(
            paths: [
                __DIR__ . '/../config/laramidjourney.php' => config_path('laramidjourney.php'),
            ],
            groups: 'laramidjourney-config'
        );
    }
}