<?php

namespace App\Classes;

class Debug
{
    public static function get($debug)
    {
        echo '<pre>';
        print_r($debug);
        echo '<pre/>';
    }
}