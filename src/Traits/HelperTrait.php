<?php

namespace MyanmarCurrency\MyanmarCurrency\Traits;

trait HelperTrait
{
    use SarDataSetTrait;

    //compose myanmar currency word. eg "သိန်း,သောင်း,etc"
    public function myanmarCurrencyWord($x, $amountNumber, $wordCount)
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
    public function completeWord(int $wordCount, string $amountNumber): string
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