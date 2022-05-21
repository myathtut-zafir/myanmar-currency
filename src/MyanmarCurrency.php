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

    function engNumberToMyanmarText(int $number)
    {
        $amountNumber = (string)$number;
        $wordCount = strlen($amountNumber);

        if ($wordCount == 7 && preg_match("/^1[0 :-]++$/", $amountNumber)) {
            return "ဆယ်သိန်း";
        }

        if ($wordCount >= 11) {
            return $amountNumber;
        }

        return $this->composeCondition($wordCount, $amountNumber);

    }

    //TODO need to chnage compose method
    function myanmarSar($x, $amountNumber, $wordCount)
    {
        $nextIndex = $x;
        $nextIndex = $nextIndex + 1;
        $methodName = $this->helper($wordCount);

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
        $prepend = false;
        if ($wordCount >= 7) {
            $prepend = true;
        }

        for ($x = 0; $x <= $wordCount - 1; $x++) {
            if ($amountNumber[$x] != 0) {
                $amountSecondDigit = array_search($amountNumber[$x], $this->myanmarNumber());// TODO should not use array_search
                $currencySar = $this->myanmarSar($x, $amountNumber, $wordCount);

                if ($x == 0 && $prepend === true) {
                    $this->condition .= "သိန်း" . $amountSecondDigit . $currencySar;
                } else {
                    $this->condition .= $amountSecondDigit . $currencySar;
                }
            }
        }
        return $this->condition;
    }
}
