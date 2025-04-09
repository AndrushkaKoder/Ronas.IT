<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\DTO\WeatherRequestDTO;

interface WeatherServiceInterface
{
    public function getWeatherByCity(WeatherRequestDTO $dto): array|string;
}
