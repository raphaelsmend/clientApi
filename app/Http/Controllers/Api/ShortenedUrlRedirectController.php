<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

class ShortenedUrlRedirectController extends Controller
{
    private $service;

    public function __construct(Container $container)
    {
        $this->service = $container->make(ClientService::class);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $urlShortened)
    {
        return $this->service->redirectShortenedUrl($urlShortened);
    }
}
