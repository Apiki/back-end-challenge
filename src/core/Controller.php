<?php

namespace App\core;

use App\core\Uri;


class Controller {

	private static $uri;
	private $name_space;
	const DIR_CONTROLLER = "\\App\\controllers\\";

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
			return new $this->name_space();
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

}