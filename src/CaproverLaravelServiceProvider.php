<?php

namespace Ariaieboy\CaproverLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CaproverLaravelServiceProvider extends PackageServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->bind('caprover-laravel', function () {
            return new CaproverLaravel();
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
