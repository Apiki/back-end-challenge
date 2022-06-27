<?php

namespace Challenge\Source\Model;

require_once __DIR__ . '/CurrencyInterface.php';

use Challenge\Source\Model\CurrencyInterface;

class BrlCurrency implements CurrencyInterface
{
    private $title;
    private $symbol;

    public function __construct()
    {
        $this->title = 'BRL';
        $this->symbol = 'R$';
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function convert(CurrencyInterface $currency,$rate,$amount): array
    {
        $result = $rate * $amount;
        return [
            "valorConvertido" => $result,
            "simboloMoeda" => $currency->getSymbol()
        ];
    }
}
