<?php

namespace App\Repositories\Contracts;

interface AddressRepositoryContract
{
    /**
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields);

    /**
     * @param int $zipcode
     * @return mixed
     */
    public function findAddressByZipcode(int $zipcode);
}
