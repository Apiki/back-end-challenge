<?php namespace App\Model;

use App\Lib\Config;

class Conversion
{
    private static $DATA = [];

    public static function all()
    {
        return self::$DATA;
    }

    public static function add($conversao)
    {
        $conversao->moeda = count(self::$DATA) + 1;
        self::$DATA[] = $conversao;
        self::save();
        return $conversao;
    }

    public static function findById( $id)
    {
        foreach (self::$DATA as $conversao) {

            // print_r($conversao);
            if ($conversao->moeda === $id) {
                return $conversao;
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