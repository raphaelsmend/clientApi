<?php
namespace Tests\Traits;

use Illuminate\Contracts\Console\Kernel;

trait CreateDatabaseTest
{
    private static $createdDatabase = false;

    /**
     * Define hooks to migrate the database before and after each test.com
     *
     * @return void
     */
    public function runCreateDatabaseTest()
    {
        if(!self::$createdDatabase){
            $this->artisan('create-database:test '.env('DB_DATABASE'));
            $this->app[Kernel::class]->setArtisan(null);
            self::$createdDatabase = true;
        }

    }
}
