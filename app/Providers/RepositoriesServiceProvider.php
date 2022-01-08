<?php

namespace App\Providers;

use App\Repositories\AddressRepository;
use App\Repositories\ClientRepository;
use App\Repositories\Contracts\AddressRepositoryContract;
use App\Repositories\Contracts\ClientRepositoryContract;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AddressRepositoryContract::class,
            AddressRepository::class
        );
        $this->app->bind(
            ClientRepositoryContract::class,
            ClientRepository::class
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
            AddressRepository::class,
            ClientRepository::class
        ];
    }
}
