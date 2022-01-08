<?php


namespace App\Traits;

use App\Http\Resources\ApiReturnErrorResource;

trait GeneralFuncions
{
    private $defaultDaysExpiration = 7;

    private function getApiReturn(bool $status, ?string $message, $data)
    {
        $dataResource = [];
        $dataResource["processed"] = $status;
        $dataResource["message"] = $message;
        $dataResource["data"] = $data;
        return (new ApiReturnErrorResource($dataResource))->toArray(null);
    }
}
