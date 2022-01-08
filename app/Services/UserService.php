<?php

namespace  App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    private $repository;

    function __construct(
        UserRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function getUser(Array $fields)
    {
        $user = $this->repository->getUserByMail($fields);

        if (empty($user)){
            return response("User nor found.", Response::HTTP_UNAUTHORIZED);
        }

        if (Hash::check($fields["password"], $user->password)) {
            return response("logged.", Response::HTTP_OK);
        }else{
            return response("incorrect password.", Response::HTTP_UNAUTHORIZED);
        }

    }
}
