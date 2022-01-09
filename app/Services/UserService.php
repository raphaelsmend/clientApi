<?php

namespace  App\Services;
ource;
use App\Http\Resources\UserResource;;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\UserServiceContract;
use App\Traits\GeneralFuncions;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserService implements UserServiceContract
{
    private $repository;

    use GeneralFuncions;

    /**
     * UserService constructor.
     * @param UserRepositoryContract $repository
     */
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
            $this->getApiReturn(true, null, (new UserResource($this->repository->find($id)))),
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
        $this->repository->update($id, $fields);

        return new JsonResponse(
            $this->getApiReturn(true, null, (new UserResource($this->repository->find($id)))),
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
