<?php

namespace MyanmarCurrency\MyanmarCurrency\Traits;


use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

trait ValidationTrait
{


    public function checklValidation($number)
    {
        $number_validation_regex = "/^(?:-(?:[1-9](?:\\d{0,2}(?:,\\d{3})+|\\d*))|(?:0|(?:[1-9](?:\\d{0,2}(?:,\\d{3})+|\\d*))))(?:.\\d+|)$/";
        if (preg_replace($number_validation_regex, '', $number)) {
            throw new InvalidArgumentException("Please type number only!");
        }

        if (preg_match("/[^0-9]/", $number)) {

            throw new InvalidArgumentException("Please type number only!");
        }
    }

    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return mixed
     */
    public function showError(\Illuminate\Contracts\Validation\Validator $validator): mixed
    {
        $data = $validator->errors()->all();
        return $data[0];
    }
}
