<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UserShowRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\Contracts\ClientServiceContract;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Container\Container;
use App\Services\ClientService;
use App\Models\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(
        UserServiceContract $userService
    )
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->getAll();
    }

    public function show(UserShowRequest $request, int $id)
    {
        return $this->userService->findById($id);
    }

    public function store(UserStoreRequest $request)
    {
        return $this->userService->store($request->validated());
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        return $this->userService->update($id, $request->validated());
    }

    public function destroy(UserShowRequest $request, int $id)
    {
        return $this->userService->destroy($id);
    }
}
