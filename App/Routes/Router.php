<?php

namespace App\Routes;

use App\Controller\IndexController;
use App\Http\Request;
use App\Http\Response;

class Router
{
    public static function get($ROOT, $CALL)
    {
        self::on($ROOT, $CALL);
    }

    public static function post($ROOT, $CALL)
    {
        self::on($ROOT, $CALL);
    }

    public static function on($RX, $BOOT)
    {
        $PARSET = $_SERVER['REQUEST_URI'];
        $PARSET = (stripos($PARSET, "/") !== 0) ? "/" . $PARSET : $PARSET;
        $RX = str_replace('/', '\/', $RX);
        $is_match = preg_match('/^' . ($RX) . '$/', $PARSET, $MXA, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            array_shift($MXA);
            $PARSET = array_map(function ($ITEM) {
                return $ITEM[0];
            }, $MXA);
            $BOOT(new Request($PARSET), new Response());
        } else {
            (new IndexController())->notFound();
        }
    }
}
