<?php

namespace TestApi\dto;

class CurrencyDTO{

    private function __construct(
        public float $amount,
        public string $from,
        public string $to,
        public float $rate
    ) {}

    public static function create(float $amount, string $from, string $to, float $rate): CurrencyDTO {
        return new self($amount, $from, $to, $rate);
    }

}