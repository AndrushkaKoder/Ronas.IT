<?php

declare(strict_types=1);

namespace App\DTO;

class WeatherResponseDTO
{
    public function __construct(
        private readonly string $city,
        private readonly array  $weather,
        private readonly array  $wind
    )
    {
    }

    public function getWeatherInfo(): array
    {
        return [
            'city' => $this->city,
            'weather' => $this->weather,
            'wind' => $this->wind
        ];
    }
}
