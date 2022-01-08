<?php

namespace App\Transformers;

use App\Models\Client;

class UrlTransformer
{
    static function transform(Client $url)
    {
        return [
            'url_shortened'  => $url->url_shortened
        ];
    }
}
