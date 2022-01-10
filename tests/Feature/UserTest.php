<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function invalid_add_user_test()
    {
        $response = $this->post('/api/User',
            [
                'email'     => 'admin@admin',
                'password'    => 'admin'
            ]
        );

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @test
     */
    public function valid_add_user_test()
    {
        $response = $this->post('/api/User',
            [
                'name'     => 'name admin',
                'email'     => 'admin@admin.com',
                'password'    => 'admin'
            ]
        );

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function get_user_test()
    {
        $user =  factory(User::class)->create();

        $response = $this->get('/api/User/'.$user->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true,
                "message" => null,
                "data" => [
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);
    }

    /**
     * @test
     */
    public function get_all_users_test()
    {
        $user =  factory(User::class)->create();
        $user2 =  factory(User::class)->create();

        $response = $this->get('/api/User');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true,
                "message" => null,
                "data" => [
                    [
                        'name' => $user->name,
                        'email' => $user->email
                    ],
                    [
                        'name' => $user2->name,
                        'email' => $user2->email
                    ]
                ]
            ]);
    }

    /**
     * @test
     */
    public function update_user_test()
    {
        $user =  factory(User::class)->create();
        $name = "other name";

        $response = $this->put('/api/User/'.$user->id,
            [
                'name'     => $name
            ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true,
                "message" => null,
                "data" => [
                    'name' => $name,
                    'email' => $user->email
                ]
            ]);
    }

    /**
     * @test
     */
    public function delete_user_test()
    {
        $user =  factory(User::class)->create();

        $response = $this->delete('/api/User/'.$user->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true
            ]);
    }

    /**
     * @test
     */
    public function invalid_login_test()
    {
        $password = "123";
        $user =  factory(User::class)->create(["password" => $password]);

        $response = $this->post('/api/login',
            [
                'email'     => $user->email,
                'password'  => $user->email
            ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function valid_login_test()
    {
        $password = "abc";
        $user =  factory(User::class)->create(["password" => Hash::make($password)]);
        $response = $this->post('/api/login',
            [
                'email'     => $user->email,
                'password'  => $password
            ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                "processed" => true
            ]);
    }
}
