<?php
namespace App;

class Routes{

	public function getRoute(string $endpoint, array $paramsUri): ?array
	{
		if ($this->isValidRoute($endpoint)) {

			$routes = $this->getRoutes();
			$route = $routes[$endpoint];

			$controller = $this->getController($route);
			$action = $this->getAction($route);
			$params = $this->getNamedParams($route, $paramsUri);
			return [
				'controller' => $controller,
				'action' => $action,
				'params' => $params,
			];
		}

		$this->invalidRouteResponse();
	}

	public function isValidRoute(string $endpoint): ?bool
	{
		$routes = $this->getRoutes();

		if (array_key_exists($endpoint, $routes)) {
			return true;
		}

		$this->invalidRouteResponse();
	}

	public function getRoutes(): array
	{
		return [
			'exchange' => [
				'params' => ['amount', 'from', 'to', 'rate'],
				'path' => 'App\Controllers\Exchange@convertCurrency'
			],
		];
	}

	private function getController(array $route): ?string
	{
		return explode("@", $route['path'])[0] ?? $this->invalidRouteResponse();
	}

	private function getAction(array $route): ?string
	{
		return explode("@", $route['path'])[1] ?? $this->invalidRouteResponse();
	}

	private function getNamedParams(array $route, array $paramsUri): ?array
	{
		$params = $route['params'] ?? [];

		if (count($params) != count($paramsUri)) {
			$this->invalidRouteResponse();
		} else {
			$namedParams = array_combine($params, $paramsUri);
			return $namedParams;	
		}

		$this->invalidRouteResponse();
	}
}