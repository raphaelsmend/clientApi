<?php

namespace App\Services\Contracts;

interface AddressServiceContract
{
    /**
     * @param int $zipcode
     * @return mixed
     */
    public function getAddressId(int $zipCode);
}
