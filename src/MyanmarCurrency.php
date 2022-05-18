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
        $sarThaung = [
            '4' => 'ကျပ်',
            '3' => 'ဆယ်',
            '2' => 'ရာ',
            '1' => 'ထောင်',
            '0' => 'သောင်း',
        ];
        $sarLak = [
            '5' => 'ကျပ်',
            '4' => 'ဆယ်',
            '3' => 'ရာ',
            '2' => 'ထောင်',
            '1' => 'သောင်း',
            '0' => 'သိန်း',
        ];
        $sarLakThan = [
            '6' => 'ကျပ်',
            '5' => 'ဆယ်',
            '4' => 'ရာ',
            '3' => 'ထောင်',
            '2' => 'သောင်း',
            '1' => 'သိန်း',
        ];
        $sarLakThans = [
            '6' => 'ကျပ်',
            '5' => 'ဆယ့်',
            '4' => 'ရာ့',
            '3' => 'ထောင့်',
            '2' => 'သောင်း',
            '1' => 'သိန်း',
        ];
        $sarYar = [
            '7' => 'ကျပ်',
            '6' => 'ဆယ်',
            '5' => 'ရာ',
            '4' => 'ထောင်',
            '3' => 'သောင်း',
            '2' => 'သိန်း',
            '1' => 'ဆယ်',
            '0' => 'ရာ',
        ];
        $sarYars = [
            '7' => 'ကျပ်',
            '6' => 'ဆယ့်',
            '5' => 'ရာ့',
            '4' => 'ထောင်',
            '3' => 'သောင်း',
            '2' => 'သိန်း',
            '1' => 'ဆယ့်',
            '0' => 'ရာ့',
        ];
        $sarHtaung = [
            '8' => 'ကျပ်',
            '7' => 'ဆယ် ',
            '6' => 'ရာ ',
            '5' => 'ထောင်',
            '4' => 'သောင်း',
            '3' => 'သိန်း',
            '2' => 'ဆယ်',
            '1' => 'ရာ',
        ];
        $sarHtaungs = [
            '8' => 'ကျပ်',
            '7' => 'ဆယ့် ',
            '6' => 'ရာ့',
            '5' => 'ထောင့်',
            '4' => 'သောင်း',
            '3' => 'သိန်း',
            '2' => 'ဆယ့်',
            '1' => 'ရာ့',
        ];

        $sarTheinThaung = [
            '9' => 'ကျပ်',
            '8' => 'ဆယ်',
            '7' => 'ရာ',
            '6' => 'ထောင်',
            '5' => 'သောင်း',
            '4' => 'သိန်း',
            '3' => 'ဆယ့်',
            '2' => 'ရာ',
            '1' => 'ထောင်',
        ];
        $sarTheinThaungs = [
            '9' => 'ကျပ်',
            '8' => 'ဆယ်',
            '7' => 'ရာ',
            '6' => 'ထောင်',
            '5' => 'သောင်း',
            '4' => 'သိန်း',
            '3' => 'ဆယ့်',
            '2' => 'ရာ့',
            '1' => 'ထောင့်',
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
                    $currencySar = $sarThaung[$x] ?? "";
                    $condition .= $amountSecondDigit . $currencySar;
                }
            }

            return $condition;
        } elseif ($wordCount === 6) { // for သိန္း 1သိန်း
            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);
                    $currencySar = $sarLak[$x];
                    $condition .= $amountSecondDigit . $currencySar;
                }
            }
            return $condition;

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
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);

                    $nextIndex = $x;
                    $nextIndex = $nextIndex + 1;

                    if (isset($amountNumber[$nextIndex]) && $amountNumber[$nextIndex] != 0) {
                        $currencySar = $sarLakThans[$x] ?? "";
                    } else {
                        $currencySar = $sarLakThan[$x] ?? "";
                    }

                    if ($x == 0) {
                        $condition .= "သိန်း" . $amountSecondDigit . $append;
                    } else {
                        $condition .= $amountSecondDigit . $currencySar;
                    }
                }
            }
            return $condition;
        } elseif ($wordCount === 8) { // for ကုုဋ သိန်းရာ
            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);

                    $nextIndex = $x;
                    $nextIndex = $nextIndex + 1;

                    if (isset($amountNumber[$nextIndex]) && $amountNumber[$nextIndex] != 0) {
                        $currencySar = $sarYars[$x] ?? "";
                    } else {
                        $currencySar = $sarYar[$x] ?? "";
                    }

                    if ($x == 0) {
                        $condition .= "သိန်း" . $amountSecondDigit . $currencySar;
                    } else {
                        $condition .= $amountSecondDigit . $currencySar;
                    }
                }
            }
            return $condition;
        } elseif ($wordCount === 9) { // for ကုုဋ သိန်းထောင်
            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);

                    $nextIndex = $x;
                    $nextIndex = $nextIndex + 1;

                    if (isset($amountNumber[$nextIndex]) && $amountNumber[$nextIndex] != 0) {
                        $currencySar = $sarHtaungs[$x] ?? "";
                    } else {
                        $currencySar = $sarHtaung[$x] ?? "";
                    }

                    if ($x == 0) {
                        $condition .= "သိန်း" . $amountSecondDigit . 'ထောင်';
                    } else {
                        $condition .= $amountSecondDigit . $currencySar;
                    }
                }
            }
            return $condition;
        } elseif ($wordCount === 10) { // for ကုုဋ သိန်းသောင်း
            for ($x = 0; $x <= $wordCount - 1; $x++) {
                if ($amountNumber[$x] != 0) {
                    $amountSecondDigit = array_search($amountNumber[$x], $myanmarNumber);

                    $nextIndex = $x;
                    $nextIndex = $nextIndex + 1;
//
                    if (isset($amountNumber[$nextIndex]) && $amountNumber[$nextIndex] != 0) {
                        $currencySar = $sarTheinThaungs[$x] ?? "";
                    } else {
                        $currencySar = $sarTheinThaung[$x] ?? "";
                    }

                    if ($x == 0) {
                        $condition .= "သိန်း" . $amountSecondDigit . 'သောင်း';
                    } else {
                        $condition .= $amountSecondDigit . $currencySar;
                    }
                }
            }
            return $condition;
        } else { // 100 သိန္း range. Don't calculate 101 or 155 for now. Let's just assume all will end in 0
            return $amountNumber;
        }
    }
}
