<?php

namespace App\Common;

trait RouterTrait
{
    public function parseUrl($path)
    {
        $path = str_replace("/", "\/", $path);
        return preg_replace("/(\{\w*})/", "(.*)", $path);
    }

    public function normalizeArgs(&$args, &$route)
    {
        preg_match_all("/(\{\w*})/", $args["route"], $matches);
        foreach ($matches[0] as $key => $value) {
            $matches[0][$key+1] = $value;
        }
        unset($matches[0][0]);

        $route = $args["route"];
        foreach ($args["args"] as $key => $value) {
            $args[ltrim(rtrim($matches[0][$key], "}"), "{")] = $value[0];
        }

        unset($args["route"]);
        unset($args["args"]);
    }
}
