<?php

namespace App\core;


class Uri {
	// Retorna a instância da própria classe, caso já exista retorna a instância existente (Singleton).
	private static $instance;
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
		return ucfirst($controller[0]);
	}

}