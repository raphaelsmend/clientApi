<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function userBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function validLoginTest()
    {
        $response = $this->post('/api/login',
            [
                'email'     => 'admin@admin',
                'password'    => 'admin'
            ]
        );

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function invalidLoginTest()
    {
        $response = $this->post('/api/login',
            [
                'email'     => 'admin@admin',
                'password'    => '111'
            ]
        );

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
