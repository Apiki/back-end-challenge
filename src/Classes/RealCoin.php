<?php

namespace App\Classes;

class RealCoin
{
    private static $coin_name = 'BRL';
    private static $coin_symbol = 'R$';

    public static function getCoinSymbol()
    {
        return self::$coin_symbol;
    }
}