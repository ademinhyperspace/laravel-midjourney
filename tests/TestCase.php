<?php

namespace Arthmelikyan\Laramidjourney\Tests;

use Arthmelikyan\Laramidjourney\LaramidjourneyServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaramidjourneyServiceProvider::class,
        ];
    }
}