<?php

namespace MyanmarCurrency\MyanmarCurrency;

use MyanmarCurrency\MyanmarCurrency\Traits\HelperTrait;
use MyanmarCurrency\MyanmarCurrency\Traits\ValidationTraitException;

class MyanmarCurrency
{
    use ValidationTraitException, HelperTrait;

    function convertMyanmarText($number): int|string
    {
        $this->checkValidationException($number); //check validation

        $wordCount = strlen($number);

        if ($wordCount == 7 && preg_match("/^1[0 :-]++$/", $number)) {
            return "ဆယ်သိန်း";
        }

        if ($wordCount >= 11) {
            return $number;
        }

        return $this->completeWord($wordCount, $number);

    }
}
