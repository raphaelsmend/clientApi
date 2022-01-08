<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryContract;

class ClientRepository implements ClientRepositoryContract
{
    private $model;

    public function __construct(Client $model)
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
        return $this->model->create($fields);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->with('address')->find($id);
    }
}
