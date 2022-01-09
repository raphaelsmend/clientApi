<?php

namespace  App\Services;

use App\Http\Resources\ClientResource;
use App\Repositories\Contracts\ClientRepositoryContract;
use App\Services\Contracts\AddressServiceContract;
use App\Services\Contracts\ClientServiceContract;
use App\Traits\GeneralFuncions;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
                $this->getApiReturn(false, 'zipCode not found', null),
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
            $this->getApiReturn(true, null, (new ClientResource($this->repository->find($id)))),
            Response::HTTP_OK
        );
    }

    /**
     * @param int $id
     * @param array $fields
     * @return mixed
     */
    public function update(int $id, array $fields)
    {
        if ( $fields["zipCode"] ) {
            $addressId = $this->addressService->getAddressId($fields["zipCode"]);

            if (! $addressId ) {
                return new JsonResponse(
                    $this->getApiReturn(false, 'zipCode not found.', null),
                    Response::HTTP_BAD_REQUEST
                );
            }

            $fields["address_id"] = $addressId;
        }

        $this->repository->update($id, $fields);

        return new JsonResponse(
            $this->getApiReturn(true, null, (new ClientResource($this->repository->find($id)))),
            Response::HTTP_OK
        );
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $this->repository->find($id)->delete();

        return new JsonResponse(
            $this->getApiReturn(true, "deleted", null),
            Response::HTTP_OK
        );
    }
}
