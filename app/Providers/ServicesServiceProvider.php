<?php

namespace App\Providers;

use App\Services\ClientService;
use App\Services\Contracts\AddressServiceContract;
use App\Services\AddressService;
use App\Services\Contracts\ClientServiceContract;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AddressServiceContract::class,
            AddressService::class
        );
        $this->app->bind(
            ClientServiceContract::class,
            ClientService::class
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            AddressService::class,
            ClientService::class
        ];
    }
}
