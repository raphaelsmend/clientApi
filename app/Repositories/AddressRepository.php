<?php

namespace App\Repositories;

use App\Models\Address;
use App\Repositories\Contracts\AddressRepositoryContract;

class AddressRepository implements AddressRepositoryContract
{
    private $model;

    /**
     * AddressRepository constructor.
     * @param Address $model
     */
    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $fields
     * @return mixed
     */
    public function create(Array $fields)
    {
        return $this->model->create($fields);
    }

    /**
     * @param int $zipcode
     * @return mixed
     */
    public function findAddressByZipcode(int $zipcode)
    {
        $address = $this->model->where("zipcode",$zipcode)->first();;
        return $address ?: null;
    }
}
