<?php

namespace MyanmarCurrency\MyanmarCurrency;

use MyanmarCurrency\MyanmarCurrency\Traits\HelperTrait;
use MyanmarCurrency\MyanmarCurrency\Traits\ValidationTraitException;

class MyanmarCurrency
{
    use ValidationTraitException, HelperTrait;

    protected string $condition = "";

    function engNumberToMyanmarNumber($number): string
    {

        $engNumber = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

        $myanmarNumber = ['၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉', '၀'];
        if ($number != "" && $number != null) {
            return str_replace($engNumber, $myanmarNumber, $number);
        }
        return "";
    }

    function engNumberToMyanmarText($number): int|string
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
