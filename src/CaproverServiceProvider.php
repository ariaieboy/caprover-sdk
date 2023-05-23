<?php

namespace Ariaieboy\Caprover;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CaproverServiceProvider extends PackageServiceProvider
{
    public function packageRegistered(): void
    {
        $this->app->bind('caprover', function () {
            return new Caprover(config('caprover.server',''),config('caprover.password',''),config('caprover.timeout',60));
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
            ->name('caprover')
            ->hasConfigFile();
    }
}
