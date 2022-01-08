<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserByMail(Array $fields)
    {
        return $this->model->where("email", $fields["email"])->first();
    }
}
