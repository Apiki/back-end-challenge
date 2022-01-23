<?php

namespace App\Classes;

class DolarCoin
{
    public static $coin_name = 'USD';
    public static $coin_symbol = '$';

    public static function getCoinSymbol()
    {
        return self::$coin_symbol;
    }
}