<?php

namespace Ariaieboy\CaproverLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ariaieboy\CaproverLaravel\CaproverLaravel
 */
class CaproverLaravel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'caprover-laravel';
    }
}
