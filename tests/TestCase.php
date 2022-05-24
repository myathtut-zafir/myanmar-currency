<?php

namespace MyanmarCurrency\MyanmarCurrency\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use MyanmarCurrency\MyanmarCurrency\MyanmarCurrencyServiceProvider;

class TestCase extends Orchestra
{
    protected $currency;
    protected function setUp(): void
    {
        parent::setUp();
        $this->currency = new \MyanmarCurrency\MyanmarCurrency\MyanmarCurrency();
        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'MyanmarCurrency\\MyanmarCurrency\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            MyanmarCurrencyServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_myanmar-currency_table.php.stub';
        $migration->up();
        */
    }
}
