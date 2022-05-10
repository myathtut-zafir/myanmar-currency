<?php

namespace MyanmarCurrency\MyanmarCurrency\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MyanmarCurrency\MyanmarCurrency\MyanmarCurrency
 */
class MyanmarCurrency extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'myanmar-currency';
    }
}
