<?php
    require 'Conversor.php';
    class Api
    {
        public static function convert($url)
        {
            $valueFrom = $url[2];
            $currencyFrom = $url[3];
            $currencyTo = $url[4];
            $valueTo = $url[5];

            $convert = new Conversor;
            return $convert->convert($valueFrom, $currencyFrom, $currencyTo, $valueTo);
        }

        public static function checkUrl($url)
        {
            $url = explode('/',$url);
            if ($url[1] != 'exchange' || count($url) < 5) {
                http_response_code(400);
                header('Content-Type: application/json');
                return json_encode(["message" => "Page not Found"]);
            }
            header('Content-Type: application/json');
            return self::convert($url);
        }

    }