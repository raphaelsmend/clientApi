<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //public $table = 'url';

    public $fillable = [
        "city",
        "district",
        "state",
        "street",
        "zipCode"
    ];

    /**
     * all clients
     */
    public function clients()
    {
        return $this->hasMany(Client::class, "address_id", "id");
    }
}
