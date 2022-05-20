<?php

namespace MyanmarCurrency\MyanmarCurrency\Traits;

trait SarDataSetTrait
{

    public function helper($count)
    {
        $data = [
            '2' => ['sarSal', 'sarSals'],
            '3' => ['sarYar', 'sarYars'],
            '4' => ['sarHtaung', 'sarHtaungs'],
            '5' => ['sarThaung', 'sarThaungs'],
            '6' => ['sarLak', 'sarLaks'],
            '7' => ['sarLakThan', 'sarLakThans'],
            '8' => ['sarTheinYar', 'sarTheinYars'],
            '9' => ['sarTheinHtaung', 'sarTheinHtaungs'],
            '10' => ['sarTheinThaung', 'sarTheinThaungs'],
        ];
        return $data[$count] ?? "";
    }

    protected function myanmarNumber(): array
    {
        return [
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
    }

    public function sarSal($x): string
    {
        $data = [
            '1' => 'ကျပ်',
            '0' => 'ဆယ်',
        ];
        return $data[$x] ?? "";
    }

    public function sarSals($x): string
    {
        $data = [
            '1' => 'ကျပ်',
            '0' => 'ဆယ့်',
        ];
        return $data[$x] ?? "";
    }

    protected function sarYar($x): string
    {
        $data = [
            '2' => 'ကျပ်',
            '1' => 'ဆယ်',
            '0' => 'ရာ',
        ];
        return $data[$x] ?? "";
    }

    protected function sarYars($x): string
    {
        $data = [
            '2' => 'ကျပ်',
            '1' => 'ဆယ့်',
            '0' => 'ရာ',
        ];
        return $data[$x] ?? "";
    }

    protected function sarHtaung($x): string
    {
        $data = [
            '3' => 'ကျပ်',
            '2' => 'ဆယ်',
            '1' => 'ရာ',
            '0' => 'ထောင်',
        ];
        return $data[$x] ?? "";
    }

    protected function sarHtaungs($x): string
    {
        $data = [
            '3' => 'ကျပ်',
            '2' => 'ဆယ့်',
            '1' => 'ရာ့',
            '0' => 'ထောင့်',
        ];
        return $data[$x] ?? "";
    }

    protected function sarThaung($x): string
    {
        $data = [
            '4' => 'ကျပ်',
            '3' => 'ဆယ်',
            '2' => 'ရာ',
            '1' => 'ထောင်',
            '0' => 'သောင်း',
        ];
        return $data[$x] ?? "";
    }

    protected function sarThaungs($x): string
    {
        $data = [
            '4' => 'ကျပ်',
            '3' => 'ဆယ်',
            '2' => 'ရာ့',
            '1' => 'ထောင့်',
            '0' => 'သောင်း',
        ];
        return $data[$x] ?? "";
    }

    protected function sarLak($x): string
    {
        $data = [
            '5' => 'ကျပ်',
            '4' => 'ဆယ်',
            '3' => 'ရာ',
            '2' => 'ထောင်',
            '1' => 'သောင်း',
            '0' => 'သိန်း',
        ];
        return $data[$x] ?? "";
    }

    protected function sarLaks($x): string
    {
        $data = [
            '5' => 'ကျပ်',
            '4' => 'ဆယ့်',
            '3' => 'ရာ့',
            '2' => 'ထောင့်',
            '1' => 'သောင်း',
            '0' => 'သိန်း',
        ];
        return $data[$x] ?? "";
    }

    protected function sarLakThan($x): string
    {
        $data = [
            '6' => 'ကျပ်',
            '5' => 'ဆယ်',
            '4' => 'ရာ',
            '3' => 'ထောင်',
            '2' => 'သောင်း',
            '1' => 'သိန်း',
        ];
        return $data[$x] ?? "";
    }

    protected function sarLakThans($x): string
    {
        $data = [
            '6' => 'ကျပ်',
            '5' => 'ဆယ့်',
            '4' => 'ရာ့',
            '3' => 'ထောင့်',
            '2' => 'သောင်း',
            '1' => 'သိန်း',
        ];
        return $data[$x] ?? "";
    }

    protected function sarTheinYar($x): string
    {
        $data = [
            '7' => 'ကျပ်',
            '6' => 'ဆယ်',
            '5' => 'ရာ',
            '4' => 'ထောင်',
            '3' => 'သောင်း',
            '2' => 'သိန်း',
            '1' => 'ဆယ်',
            '0' => 'ရာ',
        ];
        return $data[$x] ?? "";
    }

    protected function sarTheinYars($x): string
    {
        $data = [
            '7' => 'ကျပ်',
            '6' => 'ဆယ့်',
            '5' => 'ရာ့',
            '4' => 'ထောင်',
            '3' => 'သောင်း',
            '2' => 'သိန်း',
            '1' => 'ဆယ့်',
            '0' => 'ရာ့',
        ];
        return $data[$x] ?? "";
    }

    protected function sarTheinHtaung($x): string
    {
        $data = [
            '8' => 'ကျပ်',
            '7' => 'ဆယ် ',
            '6' => 'ရာ ',
            '5' => 'ထောင်',
            '4' => 'သောင်း',
            '3' => 'သိန်း',
            '2' => 'ဆယ်',
            '1' => 'ရာ',
            '0' => 'ထောင်',
        ];
        return $data[$x] ?? "";
    }

    protected function sarTheinHtaungs($x): string
    {
        $data = [
            '8' => 'ကျပ်',
            '7' => 'ဆယ့် ',
            '6' => 'ရာ့',
            '5' => 'ထောင့်',
            '4' => 'သောင်း',
            '3' => 'သိန်း',
            '2' => 'ဆယ့်',
            '1' => 'ရာ့',
            '0' => 'ထောင့်',
        ];
        return $data[$x] ?? "";
    }

    protected function sarTheinThaung($x): string
    {
        $data = [
            '9' => 'ကျပ်',
            '8' => 'ဆယ်',
            '7' => 'ရာ',
            '6' => 'ထောင်',
            '5' => 'သောင်း',
            '4' => 'သိန်း',
            '3' => 'ဆယ်',
            '2' => 'ရာ',
            '1' => 'ထောင်',
            '0' => 'သောင်း',
        ];
        return $data[$x] ?? "";
    }

    protected function sarTheinThaungs($x): string
    {
        $data = [
            '9' => 'ကျပ်',
            '8' => 'ဆယ်',
            '7' => 'ရာ',
            '6' => 'ထောင်',
            '5' => 'သောင်း',
            '4' => 'သိန်း',
            '3' => 'ဆယ့်',
            '2' => 'ရာ့',
            '1' => 'ထောင့်',
            '0' => 'သောင်း',
        ];
        return $data[$x] ?? "";
    }

}
