<?php

declare(strict_types=1);

namespace App\DTO;

readonly class WeatherRequestDTO
{
    public function __construct(
        private string $city
    )
    {
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
