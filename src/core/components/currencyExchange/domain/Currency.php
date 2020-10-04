<?php

namespace App\core\components\currencyExchange\domain;

use App\core\components\currencyExchange\application\exceptions\CurrencyCodeIsNotValid;

final class Currency
{
    const LIST_OF_SYMBOLS = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€',
    ];

    /**
     * code
     *
     * @var String
     */
    private $code;

    public function __construct(string $code)
    {
        $this->validateCode($code);
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getSymbol(): string
    {
        return self::LIST_OF_SYMBOLS[$this->code];
    }

    private function validateCode($code)
    {
        if (!in_array($code, array_flip(self::LIST_OF_SYMBOLS))) {
            throw new CurrencyCodeIsNotValid();
        }
    }
}
