<?php

namespace MyanmarCurrency\MyanmarCurrency;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MyanmarCurrencyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('myanmar-currency');
    }

    public function bootingPackage()
    {
        $this->app->singleton('myanmar-currency', function ($app) {
            return new MyanmarCurrency();
        });
    }
}
