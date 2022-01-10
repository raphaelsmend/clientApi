<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function invalid_add_client_test()
    {
        $user =  factory(User::class)->create();
        $this->actingAs($user, 'api');
        $token = $this->getbearerToken();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->post('/api/Client',
            [
                "name" => "client",
                "email" => "client@client",
                "phone1" => "22323123123",
                "zipCode" => 999999999999999,
                "address_number" => "number1"
            ]
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @test
     */
    public function valid_add_client_test()
    {
        $user =  factory(User::class)->create();
        $this->actingAs($user, 'api');
        $token = $this->getbearerToken();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->post('/api/Client',
                [
                    "name" => "client",
                    "email" => "client@client",
                    "phone1" => "22323123123",
                    "zipCode" => 57080120,
                    "address_number" => "number1"
                ]
        );

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function get_client_test()
    {
        $user =  factory(User::class)->create();
        $this->actingAs($user, 'api');
        $token = $this->getbearerToken();

        $client =  factory(Client::class)->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->get('/api/Client/'.$client->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true,
                "message" => null,
                "data" => [
                    "name" => $client->name,
                    "email" => $client->email,
                    "phone1" => $client->phone1,
                    "zipCode" => $client->address->zipCode,
                    "address_number" => $client->address_number
                ]
            ]);
    }

    /**
     * @test
     */
    public function get_all_clients_test()
    {
        $user =  factory(User::class)->create();
        $this->actingAs($user, 'api');
        $token = $this->getbearerToken();

        $client =  factory(Client::class)->create();
        $client2 =  factory(Client::class)->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->get('/api/Client');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true,
                "message" => null,
                "data" => [
                    [
                        "name" => $client->name,
                        "email" => $client->email,
                        "phone1" => $client->phone1,
                        "zipCode" => $client->address->zipCode,
                        "address_number" => $client->address_number
                    ],
                    [
                        "name" => $client2->name,
                        "email" => $client2->email,
                        "phone1" => $client2->phone1,
                        "zipCode" => $client2->address->zipCode,
                        "address_number" => $client2->address_number
                    ]
                ]
            ]);
    }

    /**
     * @test
     */
    public function update_client_test()
    {
        $user =  factory(User::class)->create();
        $this->actingAs($user, 'api');
        $token = $this->getbearerToken();

        $client =  factory(Client::class)->create();
        $name = "other name";

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->put('/api/Client/'.$client->id,
            [
                'name'     => $name
            ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true,
                "message" => null,
                "data" => [
                    'name' => $name,
                    'email' => $client->email
                ]
            ]);
    }

    /**
     * @test
     */
    public function delete_client_test()
    {
        $user =  factory(User::class)->create();
        $this->actingAs($user, 'api');
        $token = $this->getbearerToken();

        $client =  factory(Client::class)->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->delete('/api/Client/'.$client->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true
            ]);
    }

    private function getbearerToken()
    {
        $password = "abc";
        $user =  factory(User::class)->create(["password" => Hash::make($password)]);
        $response = $this->post('/api/login',
            [
                'email'     => $user->email,
                'password'  => $password
            ]);

        $json = json_decode($response->getContent(), true);
        return $json["data"]["access_token"];
    }
}
