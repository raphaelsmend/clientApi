<?php


namespace App\Traits;

use App\Http\Resources\ApiReturnErrorResource;

trait GeneralFuncions
{
    /**
     * @param bool $status
     * @param string|null $message
     * @param $data
     * @return array
     */
    private function getApiReturn(bool $status, ?string $message, $data)
    {
        $dataResource = [];
        $dataResource["processed"] = $status;
        $dataResource["message"] = $message;
        $dataResource["data"] = $data;
        return (new ApiReturnErrorResource($dataResource))->toArray(null);
    }
}
