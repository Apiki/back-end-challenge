<?php

namespace App\Service\Exchange\Coin;

abstract class AbstractCoin
{
    protected $amount = 0;
    protected $symbol = '';
 
    public function __construct(string $amount)
    {
        $this->setAmount($amount);
    }

    public function setAmount(string $amount)
    {
        if(!is_numeric($amount) || (float) $amount < 0) {
            throw new \Exception("Amount cannot be negative", 1);
        }

        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
