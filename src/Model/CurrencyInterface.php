<?php

namespace Challenge\Source\Model;

interface CurrencyInterface
{
    public function getTitle(): string;
    
    public function getSymbol(): string;

    public function convert(
        CurrencyInterface $currency,
        $rate,
        $amount
    ): array;
}