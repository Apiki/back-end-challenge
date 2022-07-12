<?php 

namespace App\Http;

class Config
{
    private static $config;

    public static function get($id, $default = null)
    {
      
        return !empty(self::$config[$id])?self::$config[$id]:$default;
    }
}