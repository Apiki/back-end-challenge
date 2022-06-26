<?php

namespace App;

class Router
{
    /**
     * Endpoint:  /exchange/{amount}/{from}/{to}/{rate}
     *
     * @return false|string[]
     */
    public function getExchangeEndpoint()
    {
        $actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
                ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $url =  explode('/', $actualLink);
        array_splice($url, 0, 3);

        if ($url[0] === 'exchange' ) {
            return $url;
        }
        return false;
    }

}
