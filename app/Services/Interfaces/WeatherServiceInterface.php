<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

interface WeatherServiceInterface
{
    public function getWeatherByCity(string $city): string;
}
