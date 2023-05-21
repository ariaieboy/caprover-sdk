<?php

namespace Ariaieboy\CaproverSDK\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ariaieboy\CaproverSdk\CaproverSdk::attachNewCustomDomainToApp
 * @method static bool attachNewCustomDomainToApp(string $appName, string $customDomain)
 * @see \Ariaieboy\CaproverSdk\CaproverSdk::removeCustomDomain
 * @method static bool removeCustomDomain(string $appName, string $customDomain)
 * @see \Ariaieboy\CaproverSdk\CaproverSdk::enableSslForCustomDomain
 * @method static bool enableSslForCustomDomain(string $appName, string $customDomain)
 */
class CaproverSDK extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'caprover-laravel';
    }
}
