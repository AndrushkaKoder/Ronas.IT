<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\WeatherRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\WeatherCityRequest;
use App\Services\Interfaces\WeatherServiceInterface;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    public function __invoke(WeatherCityRequest $request, WeatherServiceInterface $service): JsonResponse
    {
        return new JsonResponse(
            $service->getWeatherByCity(
                new WeatherRequestDTO($request->validated('city'))
            )
        );
    }
}
