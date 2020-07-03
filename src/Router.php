<?php declare (strict_types = 1);

class Router
{
    public $routes = array();

    public $variables = array();

    public function add($uri, $callback, ...$params){

        if($this->is_variable($uri)) {
            $explode_uri = explode('{', $uri);
                foreach($explode_uri as $key => $term){
                    if(!$key){
                        $uri = $term;
                        $uri = substr_replace($uri, '', -1, 1);
                        $this->variables[$uri] = array();
                    }else{
                        $matches;
                        preg_match('/[a-zA-Z0-9]+/', $term, $matches);
                        $this->variables[$uri] [$matches[0]] = '';
                    }
                }
        }

        if ($this->is_class($callback)){
            $explode_classname = explode('@', $callback);
            $classname = $explode_classname[0];
            $method = $explode_classname[1];
            $instance = new $classname();
            $this->routes[$uri] = function(...$params) use ($instance, $method){
                return $instance->$method(...$params);
            };
        }else{
            $this->routes[$uri] = $callback;
        }
    }

    public function get($uri)
    {
        $explode_uri = explode('/', $uri);
        $variables = [];
        $params = [];
        $uri_temp = '';

        foreach ($explode_uri as $value) {
            if (count($variables)) {
                array_push($params, $value);
            }
            if ($value) {
                $uri_temp = $uri_temp . "/$value";
            }
            
            if (array_key_exists($uri_temp, $this->variables)) {
                $variables = $this->variables[$uri_temp];
                $uri = $uri_temp;
            }

        }

        if(count($variables) != count($params)){
            http_response_code(400);
            echo json_encode('');
            return;
        }

        if(!array_key_exists($uri, $this->routes) && !count($variables)){
            http_response_code(400);
            echo json_encode('');
            return;
        }

        call_user_func_array($this->routes[$uri], $params);
    }

    private function is_class($callback): int{
        return preg_match('/[@]/', $callback);
    }

    private function is_variable($uri){
        return preg_match('/[{}]/', $uri);
    }
}