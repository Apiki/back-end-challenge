<?php

    class Router {

        /**
         * Método que retorna o método http de acesso ao recurso URI em questão
         * @return mixed|string
         */
        public static function getMethod(){

            return mb_strtoupper($_SERVER['REQUEST_METHOD']);

        }

        /**
         * Método de validação/defragmentação da URI em parâmetros para o EndPoint
         * Atualmente, somente o método HTTP GET está implementado
         * @param $pattern
         * @param $fn
         */
        public function get($pattern, $fn){

            $request_uri = trim($_SERVER['REQUEST_URI'], "/");

            /*echo $pattern."<br>";
            echo $request_uri."<br>";
            echo "Consistência da URL: ".self::checkPatternUri($request_uri, $pattern)."<br>";
            echo var_dump(self::getParamsURI($request_uri, $pattern))."<br>";*/

            if (!self::checkPatternUri($request_uri, $pattern)){
                self::makeResponse('Erro - URI Inválida', 400);
            }

            $arguments = self::getParamsURI($request_uri, $pattern);

            $fn(...$arguments);


        }

        /**
         * Método que verifica se a requisição GET enviada é compatível com o padrão de URL que se espera no Endpoint.
         * @param $origin_url
         * @param $pattern
         * @return int
         */
        private static function checkPatternUri($origin_url, $pattern){

            $url = trim($origin_url, "/");

            $url_array = explode('/', $url);
            $pattern_array = explode('/', $pattern);

            if (sizeof($url_array) != sizeof($pattern_array))
                return 0;


            for ($i = 0; $i < sizeof($pattern_array); $i++){

                $item = $pattern_array[$i];

                //Checa se possui chaves no padrão. Caso exista, ignora-os
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
        private static function getParamsURI($origin_url, $pattern){

            $url = trim($origin_url, "/");

            $url_array = explode('/', $url);
            $pattern_array = explode('/', $pattern);

            $vars_array = [];


            for ($i = 0; $i < sizeof($pattern_array); $i++){

                $item = $pattern_array[$i];

                //Checa se possui chaves no padrão. Caso exista, ignora-os
                if (strpos($item, '{') || strpos($item, '}')){
                    array_push($vars_array, $url_array[$i]);

                }

            }

            return $vars_array;


        }


        /**
         * Método que gera a resposta JSON.
         * @param $message
         * @param $response_code
         */
        public static function makeResponse($message, $response_code){

            header("Content-type: application/json; charset=utf-8", 1, $response_code);
            echo json_encode($message);
            exit();

        }

    }