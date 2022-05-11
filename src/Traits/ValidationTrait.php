<?php

namespace MyanmarCurrency\MyanmarCurrency\Traits;


use Illuminate\Support\Facades\Validator;

trait ValidationTrait
{

    /**
     * @param $number
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidator($number): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make([
            'number' => $number,
        ], [
            'number' => ['numeric'],
        ]);
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
