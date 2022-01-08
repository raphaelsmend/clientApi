<?php

namespace  App\Services;

use App\Http\Resources\ClientResource;
use App\Repositories\AddressRepository;
use App\Repositories\Contracts\ClientRepositoryContract;
use App\Services\Contracts\AddressServiceContract;
use App\Services\Contracts\ClientServiceContract;
use App\Traits\GeneralFuncions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;
use App\Transformers\UrlTransformer;
use App\Models\Client;

class ClientService implements ClientServiceContract
{
    private $repository;
    private $addressService;

    use GeneralFuncions;

    function __construct(
        ClientRepositoryContract $repository,
        AddressServiceContract $addressService
    ) {
        $this->repository = $repository;
        $this->addressService = $addressService;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function store(Array $fields)
    {
        $addressId = $this->addressService->getAddressId($fields["zipCode"]);

        if (! $addressId ) {
            return new JsonResponse(
                $this->getApiReturn(false, 'CEP não econtrado', null),
                Response::HTTP_BAD_REQUEST
            );
        }

        $fields["address_id"] = $addressId;
        return new JsonResponse(
            $this->getApiReturn(true, null, (new ClientResource($this->repository->create($fields)))),
            Response::HTTP_OK
        );
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return new JsonResponse(
            $this->getApiReturn(true, null, (new ClientResource($this->repository->create($this->repository->find($id)->toArray())))),
            Response::HTTP_OK
        );
    }
}
