<?php

namespace MyanmarCurrency\MyanmarCurrency;

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
        if ($number != 0) {
            $amountNumber = (string)$number;
            $result = $amountNumber;

            if (strlen($amountNumber) < 5): // for less then lah | no need to convert now
                return $amountNumber;
            elseif (strlen($amountNumber) === 5): // for less then lah | no need to convert now
                $amountFirstNumber = array_search($amountNumber[0], $myanmarNumber);
                if ($amountNumber[1] != 0):
                    $amountSecondDigit = array_search($amountNumber[1], $myanmarNumber);
                    return $amountFirstNumber . 'သောင်း' . $amountSecondDigit . 'ထောင်';
                else:
                    return $amountFirstNumber . 'သောင်း';
                endif;
            elseif (strlen($amountNumber) === 6): // for သိန္း
                $amountFirstNumber = array_search($amountNumber[0], $myanmarNumber);
                if ($amountNumber[1] != 0):
                    $amountSecondDigit = array_search($amountNumber[1], $myanmarNumber);

                    $result = $amountFirstNumber . 'သိန်း' . $amountSecondDigit . 'သောင်း';
                    if ($amountNumber[2] !== '0') {
                        $amountThirdDigit = array_search($amountNumber[2], $myanmarNumber);
                        $result .= $amountThirdDigit . 'ထောင်';
                    }
                    return $result;
                else:
                    return $amountFirstNumber . 'သိန်း';
                endif;

            elseif (strlen($amountNumber) === 7): // for သန္း
                $amountFirstNumber = array_search($amountNumber[0], $myanmarNumber);
                if ($amountNumber[0] == '1' && $amountNumber[1] == '0'):
                    return 'ဆယ်သိန်း';
                endif;

                if ($amountNumber[1] != 0):
                    $myanmarNumber1 = array_search($amountNumber[1], $myanmarNumber);
                    return $amountFirstNumber . 'ဆယ့်' . $myanmarNumber1 . 'သိန်း';
                else:
                    return 'သိန်း' . $amountFirstNumber . 'ဆယ်';
                endif;
            elseif (strlen($amountNumber) === 8): // for ကုုဋ
                $amountFirstNumber = array_search($amountNumber[0], $myanmarNumber);
                if ($amountNumber[0] == '1' && $amountNumber[1] == '0'):
                    return 'သိန်းတစ်ရာ';
                endif;

                if ($amountNumber[1] != 0):
                    $myanmarNumber1 = array_search($amountNumber[1], $myanmarNumber);
                    return 'သိန်း' . $amountFirstNumber . 'ရာ' . $myanmarNumber1 . 'ဆယ့်';
                else:
                    return 'သိန်း' . $amountFirstNumber . 'ရာ';
                endif;
            else: // 100 သိန္း range. Don't calculate 101 or 155 for now. Let's just assume all will end in 0
                return $amountNumber;
            endif;
        } else {
            return $number;
        }
    }
}
