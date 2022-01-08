<?php

namespace App\Services\Contracts;

interface ClientServiceContract
{
    /**
     * @param array $fields
     * @return mixed
     */
    public function store(array $fields);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    public function update(int $id, array $fields);
}
