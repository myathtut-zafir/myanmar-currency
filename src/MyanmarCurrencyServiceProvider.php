<?php

namespace MyanmarCurrency\MyanmarCurrency;

use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use MyanmarCurrency\MyanmarCurrency\Commands\MyanmarCurrencyCommand;

class MyanmarCurrencyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('myanmar-currency')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_myanmar-currency_table')
            ->hasCommand(MyanmarCurrencyCommand::class);

    }

    public function bootingPackage()
    {
        $this->app->singleton('myanmar-currency', function ($app) {
            return new MyanmarCurrency($app);
        });
    }


}