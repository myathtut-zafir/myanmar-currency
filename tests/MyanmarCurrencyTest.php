<?php

use function PHPUnit\Framework\assertEquals;

it('can run on 2 digit', function () {
    $response = $this->currency->convertMyanmarText('10');
    assertEquals('တစ်ဆယ်', $response);
});
it('can run on 3 digit', function () {
    $response = $this->currency->convertMyanmarText('100');
    assertEquals('တစ်ရာ', $response);
});
it('can run on 4 digit', function () {
    $response = $this->currency->convertMyanmarText('1000');
    assertEquals('တစ်ထောင်', $response);
});
it('throws exception number only', function () {
    $this->currency->convertMyanmarText('-1000');
})->throws(Exception::class);
it('throws exception start with 0', function () {
    $this->currency->convertMyanmarText('01000');
})->throws(Exception::class);
