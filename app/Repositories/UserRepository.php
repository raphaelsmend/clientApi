<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryContract
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields)
    {
        $fields["password"] = Hash::make($fields["password"]);
        return $this->model->create($fields);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @param array $fields
     * @return mixed
     */
    public function update(int $id, array $fields)
    {
        if (array_key_exists("password", $fields)) {
            $fields["password"] = Hash::make($fields["password"]);
        }
        return $this->model->find($id)->update($fields);
    }
}
