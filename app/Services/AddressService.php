<?php

namespace  App\Services;

use App\Repositories\AddressRepository;
use App\Repositories\Contracts\AddressRepositoryContract;
use App\Services\Contracts\AddressServiceContract;
use App\Traits\GeneralFuncions;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Address;
use Claudsonm\CepPromise\CepPromise;
use Claudsonm\CepPromise\Exceptions\CepPromiseException;

class AddressService implements AddressServiceContract
{
    private $repository;
    private $cepPromise;

    use GeneralFuncions;

    /**
     * AddressService constructor.
     * @param CepPromise $cepPromise
     * @param AddressRepositoryContract $repository
     */
    function __construct(
        CepPromise $cepPromise,
        AddressRepositoryContract $repository
    ) {
        $this->repository = $repository;
        $this->cepPromise = $cepPromise;
    }

    /**
     * @param array $fields
     * @return JsonResponse|mixed
     */
    public function getAddressId(int $zipCode)
    {
        $address = $this->repository->findAddressByZipcode($zipCode);

        if ($address) {
            return $address->id;
        }

        $address = $this->getAddressByAPI($zipCode);
        if ($address) {
            return $this->repository->create($address)->id;
        }

        return null;
    }

    /**
     * @param int $zipcode
     * @return array|null
     */
    private function getAddressByAPI(int $zipcode)
    {
        try {
            $address = CepPromise::fetch($zipcode)->toArray();
            return $address;
        } catch (CepPromiseException $exception) {
            return null;
        }
    }
}
