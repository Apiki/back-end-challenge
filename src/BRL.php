<?php

namespace App;

use App\Coin;

class BRL implements Coin
{
    
    const SYMBLE = 'R$';
    const CODE = 'BRL';
    
    use CoinTrait;

}