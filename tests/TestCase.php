<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Moztopia\Lavackage\LavackageServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LavackageServiceProvider::class,
        ];
    }
}
