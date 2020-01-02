<?php
    /**
    * Created by Carlos Adriano Sousa.
    * User: Carlos
    * Classe básica para extração de parâmetros da URL (Wildcards) e outras verificações de rota/requisição
    */


    class Router {



        public static function getMethod(){

            return mb_strtoupper($_SERVER['REQUEST_METHOD']);

        }


        public function get($pattern, $fn){

            $request_uri = trim($_SERVER['REQUEST_URI'], "/");

            /*echo $pattern."<br>";
            echo $request_uri."<br>";
            echo "Consistência da URL: ".self::checkPatternUri($request_uri, $pattern)."<br>";
            echo var_dump(self::getParamsURI($request_uri, $pattern))."<br>";*/

            if (!self::checkPatternUri($request_uri, $pattern))
                throw new Exception('Parâmetros Inválidosxxx', 400);


            $arguments = self::getParamsURI($request_uri, $pattern);

            //call_user_func_array($fn,$arguments);
            $fn(...$arguments);


        }

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
                    //$param_name = str_replace(['{', '}'], '', $item);
                    //$vars_array = array_merge($vars_array, [$param_name => $url_array[$i]]);

                }

            }

            return $vars_array;


        }





    }




