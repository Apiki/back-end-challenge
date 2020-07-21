<?php declare (strict_types = 1);

class Route  {

        private static $routes = Array();
        private static $pathNotFound = null;
        private static $methodNotAllowed = null;

        public static function add($expression, $function, $method = 'get'){
        
        array_push(self::$routes,Array(
          'expression' => $expression,
          'function'   => $function,
          'method'     => $method
        ));
        }

        public static function pathNotFound($function)  {
        
        self::$pathNotFound = $function;
        }

        public static function methodNotAllowed($function)  {

        self::$methodNotAllowed = $function;
        }

        public static function run($basepath = '/'){

        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        if(isset($parsed_url['path']))  {

          $path = $parsed_url['path'];
        } else {

          $path = '/';
        }

        // Pego o metodo de request da url
        $method = $_SERVER['REQUEST_METHOD'];

        $path_match_found = false;

        $route_match_found = false;

        foreach(self::$routes as $route){

        if ($basepath!=''&&$basepath!='/')  {

            $route['expression'] = '('.$basepath.')'.$route['expression'];
        }

          $route['expression'] = '^'.$route['expression'];

          $route['expression'] = $route['expression'].'$';

          if (preg_match('#'.$route['expression'].'#',$path,$matches))  {

            $path_match_found = true;

            // Verifico se o metodo chamado está correto
            if(strtolower($method) == strtolower($route['method'])){

            array_shift($matches);

              if($basepath!=''&&$basepath!='/'){
                
              array_shift($matches);
              }

              call_user_func_array($route['function'], $matches);

              $route_match_found = true;

              break;
            }
          }
        }

        // Verifico se encontrou a rota
        if(!$route_match_found){

          if($path_match_found){
            
            header("HTTP/1.0 400 Bad Request");

            if(self::$methodNotAllowed){
            
            call_user_func_array(self::$methodNotAllowed, Array($path,$method));
            }

          } else {

            header("HTTP/1.0 400 Bad Request");
            
            if(self::$pathNotFound){
            
            call_user_func_array(self::$pathNotFound, Array($path));
            }
          }
        }
      }
}

    public function retornarErro($code)
    {

        header_remove();

        http_response_code($code);

        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");

        header('Content-Type: application/json');

        $status = array(200 => '200 OK',400 => '400 Bad Request',422 => 'Unprocessable Entity',500 => '500 Internal Server Error');

        header("HTTP/1.1 ".$status[$code]);
        
        $json_response = json_encode($status[$code], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        echo $json_response;
    }