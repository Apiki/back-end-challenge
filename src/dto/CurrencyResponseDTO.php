<?php

namespace TestApi\dto;

class CurrencyResponseDTO{

    private function __construct(
        public float $valorConvertido,
        public string $simboloMoeda,
    ) {}

    public static function create(float $valorConvertido, string $simboloMoeda): CurrencyResponseDTO {
        return new self($valorConvertido, $simboloMoeda);
    }

}