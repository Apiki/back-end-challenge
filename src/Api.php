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
            try {
                $convert->convert($valueFrom, $currencyFrom, $currencyTo, $valueTo);
                http_response_code(200);
                return json_encode([
                    "valorConvertido" => $convert->valorConvertido, 
                    "simboloMoeda" => $convert->simboloMoeda
                    ]);
            }catch(Exception $e) {
                http_response_code(400);
                return json_encode(["message" => $e->getMessage()]);
            }
        }

        public static function checkUrl($url)
        {
            $url = explode('/',$url);
            header('Content-Type: application/json');
            if ($url[1] != 'exchange' || count($url) < 6) {
                http_response_code(400);
                return json_encode(["message" => "Page not Found"]);
            }
            return self::convert($url);
        }

    }