<?php

namespace App\Providers;

use App\Services\Interfaces\WeatherServiceInterface;
use App\Services\Weather\WeatherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(WeatherServiceInterface::class, WeatherService::class);
    }

    public function boot(): void
    {
    }
}
