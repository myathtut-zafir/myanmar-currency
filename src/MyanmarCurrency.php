<?php

namespace MyanmarCurrency\MyanmarCurrency;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use MyanmarCurrency\MyanmarCurrency\Traits\ValidationTrait;

class MyanmarCurrency
{
    use ValidationTrait;

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
        $myanmarNumber = [
            'တစ်' => '1',
            'နှစ်' => '2',
            'သုံး' => '3',
            'လေး' => '4',
            'ငါး' => '5',
            'ခြောက်' => '6',
            'ခုနစ်' => '7',
            'ရှစ်' => '8',
            'ကိုး' => '9',
        ];
        $sar = [
            'ကျပ်' => '4',
            'ဆယ်' => '3',
            'ရာ' => '2',
            'ထောင်' => '1',
            'သောင်း' => '0',
        ];
        $sarLak = [
            'ကျပ်' => '5',
            'ဆယ်' => '4',
            'ရာ' => '3',
            'ထောင်' => '2',
            'သောင်း' => '1',
            'သိန်း' => '0',
        ];
        $sarLakThan = [
            'ကျပ်' => '6',
            'ဆယ်' => '5',
            'ရာ' => '4',
            'ထောင်' => '3',
            'သောင်း' => '2',
            'သိန်း' => '1',
//            'သန်း' => '0',
        ];
        $sarLast = [
            'ကျပ်' => '7',
            'ဆယ် ' => '6',
            'ရာ' => '5',
            'ထောင်' => '4',
            'သောင်း' => '3',
            'သိန်း' => '2',
            'ဆယ်' => '1',
//            'ကုုဋ' => '0',
        ];

        $amountNumber = (string)$number;
        $wordCount = strlen($amountNumber);
        $condition = "";
        if ($wordCount < 5) {// for less then lah | no need to convert now
            return $amountNumber;
        } elseif ($wordCount === 5) { // သောင်း
            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);
                    $dd = array_search($x, $sar);
                    $condition .= $amountSecondDigit . $dd;
                }
            }

            return $condition;
        } elseif ($wordCount === 6) { // for သိန္း 1သိန်း
            $condition = "";
            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);
                    $dd = array_search($x, $sarLak);
                    $condition .= $amountSecondDigit . $dd;
                }
            }
            return $condition;

        } elseif ($wordCount === 7) { // for သန္း //၁၀သိန်း
            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);
                    $dd = array_search($x, $sarLakThan);
                    if ($x == 0) {
                        $condition .= "သိန်း" . $amountSecondDigit . "ဆယ်";
                    } else {
                        $condition .= $amountSecondDigit . $dd;
                    }
                }
            }
            return $condition;
        } elseif ($wordCount === 8) { // for ကုုဋ
            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);
                    $dd = array_search($x, $sarLast);
                    if ($x == 0) {
                        $condition .= "သိန်း" . $amountSecondDigit . 'ရာ';
                    } else {
                        $condition .= $amountSecondDigit . $dd;
                    }
                }
            }
            return $condition;
        } else { // 100 သိန္း range. Don't calculate 101 or 155 for now. Let's just assume all will end in 0
            return $amountNumber;
        }
    }
}
