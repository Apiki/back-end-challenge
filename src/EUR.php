<?php

namespace App;

use App\Coin;

class EUR implements Coin
{
 
    use CoinTrait;

    const SYMBLE = '€';
    const CODE = 'EUR';

    public function getSymble()
    {
        return self::SYMBLE;
    }

}

