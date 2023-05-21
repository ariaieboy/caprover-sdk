<?php

namespace Ariaieboy\CaproverSDK\Tests;

use Ariaieboy\CaproverSDK\CaproverSDKServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{

    protected function getPackageProviders($app): array
    {
        return [
            CaproverSDKServiceProvider::class,
        ];
    }
}
