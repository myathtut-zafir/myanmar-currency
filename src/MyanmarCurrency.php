<?php

namespace MyanmarCurrency\MyanmarCurrency;

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

    function engNumberToMyanmarText($number)
    {
        $validator = $this->getValidator($number);

        if ($validator->fails()) {
            return $this->showError($validator);
        }

        $amountNumber = (string)$number;
        $wordCount = strlen($amountNumber);

        if ($wordCount === 2) {
            return $this->composeCondition($wordCount, $amountNumber);
        } elseif ($wordCount === 3) {
            return $this->composeCondition($wordCount, $amountNumber);
        } elseif ($wordCount === 4) {
            return $this->composeCondition($wordCount, $amountNumber);
        } elseif ($wordCount === 5) { // သောင်း
            return $this->composeCondition($wordCount, $amountNumber);
        } elseif ($wordCount === 6) { // for သိန္း 1သိန်း
            return $this->composeCondition($wordCount, $amountNumber);

        } elseif ($wordCount === 7) { // for သန္း //၁၀သိန်း
            $append = "ဆယ့်";

            if (preg_match("/^1[0 :-]++$/", $amountNumber)) //check start with number 1 and other are zero
            {
                return "ဆယ်သိန်း";
            }

            if (preg_match("/^.{1}[0 :-]++$/", $amountNumber)) //check start with number and other are zero
            {
                $append = "ဆယ်";
            }

            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $this->myanmarNumber());

                    $currencySar = $this->myanmarSar($x, $amountNumber, $wordCount);

                    if ($x == 0) {
                        $this->condition .= "သိန်း" . $amountSecondDigit . $append;
                    } else {
                        $this->condition .= $amountSecondDigit . $currencySar;
                    }
                }
            }
            return $this->condition;
        } elseif ($wordCount === 8) { // for ကုုဋ သိန်းရာ
            return $this->composeCondition($wordCount, $amountNumber, true);
        } elseif ($wordCount === 9) { // for ကုုဋ သိန်းထောင်
            return $this->composeCondition($wordCount, $amountNumber, true);
        } elseif ($wordCount === 10) { // for ကုုဋ သိန်းသောင်း
            return $this->composeCondition($wordCount, $amountNumber, true);
        } else { // 100 သိန္း range. Don't calculate 101 or 155 for now. Let's just assume all will end in 0
            return $amountNumber;
        }
    }

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
     * @param bool $prepend
     * @return string
     */
    public function composeCondition(int $wordCount, string $amountNumber, bool $prepend = false): string
    {
        for ($x = 0; $x <= $wordCount - 1; $x++) {
            if ($amountNumber[$x] != 0) {
                $amountSecondDigit = array_search($amountNumber[$x], $this->myanmarNumber());
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
