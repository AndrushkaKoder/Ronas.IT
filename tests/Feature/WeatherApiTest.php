<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherApiTest extends TestCase
{
    private array $cities = [
        'Moscow',
        'London',
        'New York',
        'Barcelona',
        'Samara',
        'Saint Petersburg'
    ];

    public function test_that_api_return_correct_response(): void
    {
            $response = $this->get('/api/weather?city=' . $this->cities[rand(0, count($this->cities) - 1)]);

            $response->assertStatus(200);
            $response->assertJsonStructure([
                'city',
                'weather' => [],
                'wind' => [],
            ]);
    }

}
