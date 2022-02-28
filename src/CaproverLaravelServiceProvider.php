<?php

namespace Ariaieboy\CaproverLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Ariaieboy\CaproverLaravel\Commands\CaproverLaravelCommand;

class CaproverLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('caprover-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_caprover-laravel_table')
            ->hasCommand(CaproverLaravelCommand::class);
    }
}
