<?php
namespace App;

class Api extends Routes {

	private $uri;

	function __construct()
	{
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->uri = explode('/', $uri);
	}

  public function start(): void
	{
		$endpoint = $this->getEndpointFromURI();
		$paramsUri = $this->getParamsFromURI();

		$route = $this->getRoute($endpoint, $paramsUri);
		if ($route) {
			$this->callAction($route);
		}
	}

	private function getEndpointFromURI(): string
	{
		return $this->uri[1];
	}

	private function getParamsFromURI(): array
	{
		return array_slice($this->uri, 2);
	}

	private function callAction(array $route): void
	{
		extract($route);
		$class = new $controller();
		call_user_func(array($class, $action), $params);
	}

	public function invalidRouteResponse(): void
	{
		http_response_code(400);
		echo json_encode(array(
			'message' => 'Rota inválida!'
		));
		exit;
	}

	public function successResponse(array $data): void
	{
		http_response_code(200);
		echo json_encode($data);
		exit;
	}
}