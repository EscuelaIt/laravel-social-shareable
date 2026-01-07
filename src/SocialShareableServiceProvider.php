<?php

declare(strict_types=1);

namespace Escuelait\SocialShareable;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SocialShareableServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/social-shareable.php',
            'social-shareable'
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/social-shareable.php' =>
                config_path('social-shareable.php'),
            ], 'social-shareable-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/social-shareable'),
            ], 'social-shareable-views');

            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/social-shareable/assets'),
            ], 'social-shareable-raw-assets');

            $this->publishes([
                __DIR__.'/../resources/assets' => resource_path('vendor/social-shareable'),
            ], 'social-shareable-assets');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'social-shareable');

        Blade::anonymousComponentNamespace(
            'social-shareable::components',
            'social-shareable'
        );
    }

}
