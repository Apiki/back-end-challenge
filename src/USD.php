<?php

namespace App;

use App\Coin;

class USD implements Coin
{

    const SYMBLE = '$';
    const CODE = 'USD';

    use CoinTrait;

    public function getSymble()
    {
        return self::SYMBLE;
    }
}
