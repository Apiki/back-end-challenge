<?php

namespace App\Model;

class Coins
{
    public static function getSymbol(String $coin)
    {
        $arrCoin = [
            'BRL'=>'R$',
            'USD'=>"$",
            'EUR'=>"€"
        ];
        return $arrCoin[$coin];
    }
}