<?php

namespace Ariaieboy\Caprover\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            'Ariaieboy\Caprover\CaproverServiceProvider',
        ];
    }
}
