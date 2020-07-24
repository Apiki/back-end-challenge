<?php

namespace App;

use App\Coin;

class BRL implements Coin
{
    
    const SYMBOL = 'R$';
    const CODE = 'BRL';
    
    use CoinTrait;

    public function getSymbol()
    {
        return self::SYMBOL;
    }
}