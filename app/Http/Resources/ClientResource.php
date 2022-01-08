<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this["name"],
            'email' => $this["email"],
            'phone1' => $this["phone1"],
            'phone2' => $this["phone2"],
            'address_id' => $this["address_id"],
            "city" => $this["address"]->city,
            "district" => $this["address"]->district,
            "state" =>$this["address"]->state,
            "street" => $this["address"]->street,
            "zipCode" => $this["address"]->zipCode,
            'address_number' => $this["address_number"],
            'address_complement' => $this["address_complement"],
            'created_at' => $this["created_at"]
        ];
    }
}
