<?php

namespace MyanmarCurrency\MyanmarCurrency\Commands;

use Illuminate\Console\Command;

class MyanmarCurrencyCommand extends Command
{
    public $signature = 'myanmar-currency';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
