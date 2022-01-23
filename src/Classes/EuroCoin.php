<?php

namespace App\Classes;

class EuroCoin
{
    public static $coin_name = 'EUR';
    public static $coin_symbol = '€';

    public static function getCoinSymbol()
    {
        return self::$coin_symbol;
    }
}