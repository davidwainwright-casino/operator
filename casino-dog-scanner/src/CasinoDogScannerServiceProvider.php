<?php

namespace Wainwright\CasinoDogScanner;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wainwright\CasinoDogScanner\Commands\CasinoDogScannerCommand;

class CasinoDogScannerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('casino-dog-scanner')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_casino-dog-scanner_table')
            ->hasCommand(CasinoDogScannerCommand::class);
    }
}
