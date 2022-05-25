<?php

namespace MyanmarCurrency\MyanmarCurrency\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use MyanmarCurrency\MyanmarCurrency\MyanmarCurrency;
use Orchestra\Testbench\TestCase as Orchestra;
use MyanmarCurrency\MyanmarCurrency\MyanmarCurrencyServiceProvider;

class TestCase extends Orchestra
{
    protected $currency;

    protected function setUp(): void
    {
        parent::setUp();
        $this->currency = new MyanmarCurrency();
        Factory::guessFactoryNamesUsing(
            fn(string $modelName) => 'MyanmarCurrency\\MyanmarCurrency\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            MyanmarCurrencyServiceProvider::class,
        ];
    }
}
