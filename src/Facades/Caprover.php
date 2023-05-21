<?php

namespace Ariaieboy\CaproverSDK\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ariaieboy\Caprover\CaproverSdk::attachNewCustomDomainToApp
 * @method static bool attachNewCustomDomainToApp(string $appName, string $customDomain)
 * @see \Ariaieboy\CaproverSdk\CaproverSdk::removeCustomDomain
 * @method static bool removeCustomDomain(string $appName, string $customDomain)
 * @see \Ariaieboy\CaproverSdk\CaproverSdk::enableSslForCustomDomain
 * @method static bool enableSslForCustomDomain(string $appName, string $customDomain)
 */
class Caprover extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'caprover';
    }
}
