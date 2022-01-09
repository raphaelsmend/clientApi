<?php

namespace  App\Services;

use App\Http\Resources\ClientResource;
use App\Http\Resources\UserResource;
use App\Repositories\AddressRepository;
use App\Repositories\Contracts\ClientRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\AddressServiceContract;
use App\Services\Contracts\ClientServiceContract;
use App\Services\Contracts\UserServiceContract;
use App\Traits\GeneralFuncions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;
use App\Transformers\UrlTransformer;
use App\Models\Client;

class UserService implements UserServiceContract
{
    private $repository;

    use GeneralFuncions;

    function __construct(
        UserRepositoryContract $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * @param array $fields
     * @return JsonResponse
     */
    public function store(Array $fields)
    {
        return new JsonResponse(
            $this->getApiReturn(true, null, (new UserResource($this->repository->create($fields)))),
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
