<?php

namespace Hadirteknologi\Authservice;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;

class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/service.php' => config_path('auth-service.php'),
        ]);

        $socialite = $this->app->make(Factory::class);
        $socialite->extend('hadirauth', function () use ($socialite) {
            $config = config('services.hadirauth');
            return $socialite->buildProvider(PassportServiceProvider::class, $config);
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/service.php',
            'service'
        );
    }
}
