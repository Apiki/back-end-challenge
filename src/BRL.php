<?php

namespace App;

use App\Coin;

class BRL implements Coin
{
    
    const SYMBLE = 'R$';
    const CODE = 'BRL';
    
    use CoinTrait;

    public function getSymble()
    {
        return self::SYMBLE;
    }
}