<?php

namespace Tests\Feature;

use App\Models\Client;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Faker\Factory as Faker;

class UrlTest extends TestCase
{
    /**
     * @test
     */
    public function urlBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function listUrl()
    {
        $url =  factory(Client::class)->create();

        $response = $this->get('/api/Client');

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('url', [
            'url_shortened' => $url->url_shortened
        ]);
    }

    /**
     * @test
     */
    public function createValidUrl()
    {
        $faker = $faker = Faker::create();
        $url_original = $faker->url;

        $response = $this->post('/api/Client',
            [
                'url_original'     => $url_original
            ]
        );

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('url', [
            'url_original' => $url_original
        ]);
    }

    /**
     * @test
     */
    public function createInvalidUrl()
    {
        $faker = $faker = Faker::create();
        $url_original = $faker->url;

        $response = $this->post('/api/Client',
            [

            ]
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }
}
