<?php

namespace App\core;

use App\components\Helpers;
use App\components\Httpd;


class Uri {
	// Retorna a instância da própria classe, caso já exista retorna a instância existente (Singleton).
	private static $instance;
	public static $controller;
	public static $action;
	protected static $is_api = false;
	public static $params;

	/**
	 * @return string ignorando query string
	*/
	public static function getUri() {
		return parse_url(substr($_SERVER['REQUEST_URI'],1), PHP_URL_PATH);
	}
	// Garante que só seja carregada apenas uma instância da classe.
	public static function getInstance() {
		if( empty(self::$instance) ){
			self::$instance = new self;
		}
		return self::$instance;
	}
	/**
	 * Retorna o controller levando em consideração que na url: http://localhost:8000/exechange/10
	 * o primeiro valor da uri será sempre o controller seguindo a convenção da orientação a objetos
	 * http://localhost:8000/controller/action/param
	 * @return string que representa o controller a ser carregado caso exista.
	*/
	public static function getController() {
		$controller = explode('/', self::getUri());
		$controller = ucfirst($controller[0]);
		self::$controller = $controller;
		return $controller;
	}

	public static function getAction() {

		$uri = self::getUri();
		$uri = Helpers::removeLastBar($uri);
		$uriArray = explode('/', $uri);

		if(isset(CONFIG['api_actions'])){
			$i = 0;
			foreach($uriArray as $action){
				foreach(CONFIG['api_actions'] as $key => $api_action){
					$key 		= strtoupper($key);
					$action = strtoupper($action);
					if($key === $action){
						if( (is_array($api_action) && in_array(strtoupper($uriArray[$i+1]), $api_action)) || ($api_action === strtoupper($uriArray[$i+1])) ){
							$method = strtolower($action . "_to_" . strtoupper($uriArray[$i+1]));
							self::$action = $method;
							self::$is_api = true;
							return $method;
						}
					}
				}
				$i++;
			}
		}

		$action = (!empty($uriArray[1])) ? strtolower($uriArray[1]) : null;

		return $action;
	}

	public static function getParams() {

		$uri = self::getUri();
		$uriArray = explode('/', $uri);

		if(isset(CONFIG['api_actions']) && self::$is_api){
			if( (!is_numeric($uriArray[1])) || (!is_numeric($uriArray[4])) ){
				$erro = [
					'msg' 	=> 'Bad Request',
					'code' 	=> 400
				];
				$erro = \json_encode($erro);
				throw new \Exception($erro);
			}
			$params['amount'] = $uriArray[1];
			$params['rate']	 = $uriArray[4];

			self::$params = $params;
			return $params;
		}

	}


}