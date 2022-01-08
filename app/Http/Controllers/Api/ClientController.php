<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Services\Contracts\ClientServiceContract;
use Illuminate\Container\Container;
use App\Services\ClientService;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $clientService;

    public function __construct(
        ClientServiceContract $clientService
    )
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        return $this->clientService->getAll();
    }

    public function show(ShowClientRequest $request, int $id)
    {
        return $this->clientService->findById($id);
    }

    public function store(StoreClientRequest $request)
    {
        return $this->clientService->store($request->validated());
    }

    public function update(UpdateClientRequest $request, int $id)
    {
        return $this->clientService->update($id, $request->validated());
    }

    public function destroy(ShowClientRequest $request, int $id)
    {
        return $this->clientService->destroy($id);
    }
}
