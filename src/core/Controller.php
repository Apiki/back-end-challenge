<?php

namespace App\core;

use App\core\Uri;


class Controller {

	private static $uri;
	private $name_space;
	const DIR_CONTROLLER = "\\App\\controllers\\";
	private $action;
	private $params;

	/**
	 * Retorna uma instância da classe Uri do core do micro framework com a idéia de composição.
	 * @return object 
	*/
	public static function Uri(){
		return self::$uri = Uri::getInstance();
	}
	/**
	 * Tenta fazer o carregamento do controller se tudo ocorrer bem.
	 * @return object or string com a mensagem de erro a ser retornada na requisição.
	*/
	public function load() {
		if( $this->isHome() ){
			return $this->controllerHome();
		}
		$this->name_space = self::DIR_CONTROLLER . Controller::Uri()::getController();
		if( class_exists($this->name_space) ){
			$this->setAction();
			$this->setParams();
		}else{
			$erro = [
				'msg' 	=> 'Router not found',
				'code' 	=> 404
			];
			$erro = \json_encode($erro);
			throw new \Exception($erro);
		}
	}
	/**
	 * Verifica se a url requisitada é a home page.
	 * @return boolean
	*/
	private function isHome() {
		return (self::Uri()::getUri() == '/');
	}

	protected function setAction() {
		$this->action = Controller::Uri()::getAction();
	}

	protected function setParams() {
		$this->params = Controller::Uri()::getParams();
	}

	public function exec() {
		$controller = new $this->name_space();
		$action = $controller::Uri()::getAction();
		$params = $controller::Uri()::getParams();
		$controller->$action($params);
	}

	public function status($status){
		header('Content-Type: application/json;charset=utf-8');
		http_response_code($status);
	}

}