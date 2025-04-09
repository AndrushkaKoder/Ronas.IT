<?php

namespace Tests\Feature;

use Tests\TestCase;

class WithoutCityTest extends TestCase
{

    private string $errorPath = '/api/weather?city=';

    public function test_that_response_without_city_return_error(): void
    {
        $response = $this->get(
            $this->errorPath,
            ['Accept' => 'application/json']
        );

        $response->assertStatus(422);
    }
}
