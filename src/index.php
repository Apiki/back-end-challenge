<?php 
require_once __DIR__ . '/output.php';
require_once __DIR__ . '/request.php';
require_once __DIR__ . '/exchange.php';

class API { 
	public function init() {
		$request = new Request();
		$request = $request->handleRequest();
		$output = null;
		if(!is_null($request)) {
			$exchange = new Exchange($request);
			$output = $exchange->calculate();
			$output = new Output($output);
			$output->dataResponse();
		} else {
			Output::invalidParameter('Parametros inválidos');
		}
		return $output;
	}

}


?>