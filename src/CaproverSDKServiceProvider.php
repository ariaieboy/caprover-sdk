<?php

namespace Ariaieboy\CaproverSDK;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CaproverSDKServiceProvider extends PackageServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->bind('caprover-laravel', function () {
            return new CaproverSDK();
        });
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('caprover-laravel')
            ->hasConfigFile();
    }
}
