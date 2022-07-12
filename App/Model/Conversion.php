<?php namespace App\Model;

use App\Http\Config;

class Conversion
{
    private static $DATA = [];

    public static function all()
    {
        return self::$DATA;
    }

    public static function add($value_o)
    {
        $value_o->moeda = count(self::$DATA) + 1;
        self::$DATA[] = $value_o;
        self::save();
        return $value_o;
    }

    public static function findById( $id)
    {
        foreach (self::$DATA as $value_o) {

            if ($value_o->moeda === $id) {
                return $value_o;
            }
        }
        return [];
    }

    public static function load()
    {
        $DB_PATH = Config::get('DB_PATH', __DIR__ . '/../../db.json');
        self::$DATA = json_decode(file_get_contents($DB_PATH));
    }

    public static function save()
    {
        $DB_PATH = Config::get('DB_PATH', __DIR__ . '/../../db.json');
        file_put_contents($DB_PATH, json_encode(self::$DATA, JSON_PRETTY_PRINT));
    }
}