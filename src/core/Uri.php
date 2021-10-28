<?php

namespace App\core;

use App\components\Helpers;

class Uri {
	// Retorna a instância da própria classe, caso já exista retorna a instância existente (Singleton).
	private static $instance;
	public static $controller;
	public static $action;
	protected static $is_api;
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
		$uriArray = explode('/', $uri);

		if(isset(CONFIG['api_actions'])){
			$i = 0;
			foreach($uriArray as $action){
				foreach(CONFIG['api_actions'] as $key => $api_action){
					if($key === $action){
						if(is_array($api_action) && in_array($uriArray[$i+1], $api_action)){
							$method = strtolower($action) . "_to_" . strtolower($uriArray[$i+1]);
							self::$action = $method;
							self::$is_api = true;
							return $method;
						}
					}
				}
				$i++;
			}
		}

		$action = strtolower($uriArray[1]);

		if(!is_string($action)){
			$erro = [
				'msg' 	=> 'Bad Request',
				'code' 	=> 400
			];
			$erro = \json_encode($erro);
			throw new \Exception($erro);
		}

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
			$params['for'] = $uriArray[1];
			$params['to']	 = $uriArray[4];

			self::$params = $params;
			return $params;
		}

	}


}