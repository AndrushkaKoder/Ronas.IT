<?php

declare(strict_types=1);

namespace App\Services\Weather;

use App\DTO\WeatherRequestDTO;
use App\DTO\WeatherResponseDTO;
use App\Exceptions\NoFoundCityException;
use App\Helpers\CorrectPathHelper;
use App\Services\Interfaces\WeatherServiceInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

readonly class WeatherService implements WeatherServiceInterface
{

    use CorrectPathHelper;

    private ?string $weatherUrl;
    private ?string $directUrl;
    private ?string $apiToken;

    public function __construct(private Client $client)
    {
        $this->apiToken = Config::get('weather.token');
        $this->weatherUrl = Config::get('weather.weather_url');
        $this->directUrl = Config::get('weather.direct_url');
    }

    public function getWeatherByCity(WeatherRequestDTO $dto): string|array
    {
        try {
            [$lat, $lon] = $this->getCoordinatesByCityName($dto->getCity());

            if (!$lat || !$lon) {
                throw new NoFoundCityException('City not found. Please, try again');
            }

            $response = $this->client->get(
                $this->correctPathForGet($this->weatherUrl) . http_build_query([
                    'lat' => $lat,
                    'lon' => $lon,
                    'appid' => $this->apiToken
                ]));

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody()->getContents(), true);

                return (new WeatherResponseDTO(
                    city: $dto->getCity(),
                    weather: data_get($data, 'weather.0') ?? [],
                    wind: data_get($data, 'wind') ?? []
                ))->getWeatherInfo();
            } else {
                return ['error' => 'Some problems with api. Please, try later'];
            }
        } catch (NoFoundCityException $cityException) {
            return ['error' => $cityException->getMessage()];
        }
    }

    public function getCoordinatesByCityName(string $city): ?array
    {
        $url = $this->correctPathForGet($this->directUrl) . http_build_query([
                'q' => $city,
                'limit' => 1,
                'appId' => $this->apiToken
            ]);

        $response = $this->client->get($url);
        if ($response->getStatusCode() === 200) {
            $body = json_decode($response->getBody()->getContents(), true);

            return [
                data_get($body, '0.lat'),
                data_get($body, '0.lon')
            ];
        }

        return null;
    }
}
