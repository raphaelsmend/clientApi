<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Container\Container;

class LoginController extends Controller
{
    private $service;

    public function __construct(Container $container)
    {
        $this->service = $container->make(UserService::class);
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        return $this->service->getUser($request->validated());
    }
}
