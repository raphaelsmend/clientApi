<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\DatabaseMigrationsOnce;
use Tests\Traits\CreateDatabaseTest;
use Tests\Traits\DatabaseSeedsOnce;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    use DatabaseMigrationsOnce, DatabaseTransactions, CreateDatabaseTest, WithFaker, DatabaseSeedsOnce;

    protected function setUpTraits(){
        $this->runCreateDatabaseTest();
        $this->runDatabaseMigrationsOnce();
        $this->runSeedsOnce();
        parent::setUpTraits();
    }
}
