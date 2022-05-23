<?php

namespace MyanmarCurrency\MyanmarCurrency;

use Illuminate\Support\Facades\Log;
use MyanmarCurrency\MyanmarCurrency\Traits\SarDataSetTrait;
use MyanmarCurrency\MyanmarCurrency\Traits\ValidationTrait;

class MyanmarCurrency
{
    use ValidationTrait, SarDataSetTrait;

    protected string $condition = "";

    function engNumberToMyanmarNumber($number): string
    {
        $validator = $this->getValidator($number);

        if ($validator->fails()) {
            return $this->showError($validator);
        }

        $engNumber = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

        $myanmarNumber = ['၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉', '၀'];
        if ($number != "" && $number != null) {
            return str_replace($engNumber, $myanmarNumber, $number);
        }
        return "";
    }

    function engNumberToMyanmarText(int $number): int|string
    {
        $wordCount = strlen($number);

        if ($wordCount == 7 && preg_match("/^1[0 :-]++$/", $number)) {
            return "ဆယ်သိန်း";
        }

        if ($wordCount >= 11) {
            return $number;
        }

        return $this->composeCondition($wordCount, $number);

    }

    //compose myanmar currency word. eg "သိန်း,သောင်း,etc"
    function myanmarCurrencyWord($x, $amountNumber, $wordCount)
    {
        $nextIndex = $x;
        $nextIndex = $nextIndex + 1;
        $methodName = $this->methodNamesHelper($wordCount);

        if (isset($amountNumber[$nextIndex]) && $amountNumber[$nextIndex] != 0) {
            return $this->{$methodName[1]}($x);
        }
        return $this->{$methodName[0]}($x);
    }

    /**
     * @param int $wordCount
     * @param string $amountNumber
     * @return string
     */
    public function composeCondition(int $wordCount, string $amountNumber): string
    {
        $prepend = $this->isPrepend($wordCount);

        for ($x = 0; $x <= $wordCount - 1; $x++) {
            if ($amountNumber[$x] != 0) {
                $amountSecondDigit = $this->myanmarNumber($amountNumber[$x]);
                $currencySar = $this->myanmarCurrencyWord($x, $amountNumber, $wordCount);

                if ($x == 0 && $prepend === true) {
                    $this->condition .= "သိန်း" . $amountSecondDigit . $currencySar;
                } else {
                    $this->condition .= $amountSecondDigit . $currencySar;
                }
            }
        }
        return $this->condition;
    }

    /**
     * @param int $wordCount
     * @return bool
     */
    public function isPrepend(int $wordCount): bool
    {
        $prepend = false;
        if ($wordCount >= 7) {
            $prepend = true;
        }
        return $prepend;
    }
}
