<?php

namespace App\Repositories\Contracts;

interface UserRepositoryContract
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields);

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param int $id
     * @param array $fields
     * @return mixed
     */
    public function update(int $id, array $fields);
}
