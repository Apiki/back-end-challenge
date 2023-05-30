<?php

namespace Currency;

class Converter {
    private $exchangeRates = [
        'USD' => [
            'BRL' => 5,
            'EUR' => 0.93
        ],
        'BRL' => [
            'USD' => 0.2,
            'EUR' => 0.18
        ],
        'EUR' => [
            'BRL' => 5.41,
            'USD' => 1.07
        ]
    ];
}
