<?php

namespace App\Classes;

class Router
{

    /**
     * Retorna o Método HTTP solicitado
     * @return mixed|string
     */
    public static function getMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Tratamentos dos parâmetros URI para os Endpoints
     * @param $pattern
     * @param $params
     */
    public function get($pattern, $params)
    {
        $request_uri = trim($_SERVER['REQUEST_URI'], "/");

        if (self::checkUri($request_uri, $pattern) == false){
            Response::catch('Erro. A URL Solicitada não existe!', 400);
        }

        $args = self::getParamsURI($request_uri, $pattern);
        $params(...$args);
    }

    /**
     * Verifica se a requisição GET está nos parâmetros definidos do Endpoint
     * @param $origin_url
     * @param $pattern
     * @return int
     */
    private static function checkUri($origin_url, $pattern){

        $url = trim($origin_url, "/");

        $url_array = explode('/', $url);
        $pattern_array = explode('/', $pattern);

        if (sizeof($url_array) != sizeof($pattern_array))
            return 0;


        for ($i = 0; $i < sizeof($pattern_array); $i++){

            $item = $pattern_array[$i];

            if (strpos($item, '{') || strpos($item, '}')){
                continue;
            }

            if (!isset($url_array[$i]))
                return 0;

            if ($url_array[$i] != $item)
                return 0;

        }

        return 1;

    }

    /**
     * Método que extrai os parâmetros da URL em questão
     * @param $origin_url
     * @param $pattern
     * @return array
     */
    private static function getParamsURI($origin_url, $pattern)
    {
        $url = trim($origin_url, "/");

        $url_array = explode('/', $url);
        $pattern_array = explode('/', $pattern);

        $vars_array = [];

        for ($i = 0; $i < sizeof($pattern_array); $i++){

            $item = $pattern_array[$i];

            if (strpos($item, '{') || strpos($item, '}')){
                array_push($vars_array, $url_array[$i]);

            }

        }

        return $vars_array;
    }

}