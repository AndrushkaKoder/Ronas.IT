<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\WeatherRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\WeatherCityRequest;
use App\Services\Interfaces\WeatherServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function __invoke(WeatherCityRequest $request, WeatherServiceInterface $service): JsonResponse
    {
        $city = $request->validated('city');

        return Cache::remember($city, 3600, function () use ($service, $city) {
            return new JsonResponse(
                $service->getWeatherByCity(
                    new WeatherRequestDTO($city)
                )
            );
        });
    }
}
