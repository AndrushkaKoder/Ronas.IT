<?php

declare(strict_types=1);

namespace App\Services\Weather;

use App\Services\Interfaces\WeatherServiceInterface;

class WeatherService implements WeatherServiceInterface
{

    public function getWeatherByCity(string $city): string
    {
        return $city;
    }
}
