<?php

namespace Apiki\Framework;

require __DIR__ . '/Moeda.php';

class Router
{
  private $routes = [];
  private $method;
  private $path;
  private $params;

  public function __construct($method, $path)
  {
      $this->method = $method;
      $this->path = $path;
  }

  public function get(string $route, callable $action)
  {
      $this->add('GET', $route, $action);
  }

  public function add(string $method, string $route, callable $action)
  {
      $this->routes[$method][$route] = $action;
  }

  public function getParams()
  {
      return $this->params;
  }

  public function handler()
  {
      if (empty($this->routes[$this->method])) {
          return false;
      }

      if (isset($this->routes[$this->method][$this->path])) {
          return $this->routes[$this->method][$this->path];
      }

      foreach ($this->routes[$this->method] as $route => $action) {
          $result = $this->checkUrl($route, $this->path);
          if ($result >= 1) {
              return $action;
          }
      }

      return false;
  }

  private function checkUrl(string $route, $path)
  {
    if($path == "/"){
      return 0;
    }

    $variables = explode('/', $path);
    foreach ($variables as $key => $value) {
      if($key != 0 && $value == ''){
        return 0;
      }
    }

    $moeda = new Moeda();

    if($moeda->converterValor((float)$variables[2], (float)$variables[5]) != '' && ctype_upper($variables[3]) && ctype_upper($variables[4])) {
			$valorConvertido['valorConvertido'] = $moeda->converterValor((float)$variables[2], (float)$variables[5]);
			$valorConvertido['simboloMoeda'] = (string)$moeda->SimboloMoeda($variables[4]);
		}

    if(!isset($valorConvertido)){
      return 0;
    }

    $this->params = json_encode($valorConvertido);

    return 1;

  }



}
