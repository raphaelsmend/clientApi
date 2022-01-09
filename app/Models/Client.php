<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $fillable = [
        'name',
        'email',
        'phone1',
        'phone2',
        'address_id',
        'address_number',
        'address_complement'
    ];

    /**
     * address
     */
    public function address()
    {
        return $this->belongsTo(Address::class, "address_id", "id");
    }
}
