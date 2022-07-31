<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo utilizado para obter as rotas e os Parâmetros das mesmas.
 *
 * @category Router
 * @package  Back-end
 * @author   Seu Nome <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */

namespace App;

/**
 * Class Router
 *
 * @category Router
 * @package  Back-end
 * @author   Seu Nome <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */
class Router
{
    /**
     * Rota
     *
     * @var string|null
     */
    private ?string $_route;
    /**
     * Caminho
     *
     * @var string
     */
    private string $_path;

    /**
     * Classe Request
     *
     * @var Request
     */
    public Request $request;
    /**
     * Classe Response
     *
     * @var Response
     */
    public Response $response;
    /**
     * Parâmetros da rota
     *
     * @var array
     */
    public array $routeParams;
    /**
     * Função construtora que recibe as classes Request e Response
     *
     * @param Request  $request  Class Request
     * @param Response $response Class Response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    /**
     * Obter e validar a rota
     *
     * @return string|null
     */
    private function _getRoute(): ?string
    {
        $routes = [
            '/exchange',
            '/exchange/{qty}',
            '/exchange/{qty}/{from}',
            '/exchange/{qty}/{from}/{to}',
            '/exchange/{qty}/{from}/{to}/{rate}'
        ];
        $routeParams = explode('/', trim($this->_path, '/'));
        $routeParamsCount = count($routeParams);
        $routesCount = count($routes);
        if ($routeParamsCount > $routesCount) {
            return null;
        }
        return $routes[$routeParamsCount - 1];
    }

    /**
     * Fazer regex na rota
     *
     * @return string
     */
    private function _getRouteRegex(): string
    {
        return "@^" .
            preg_replace_callback(
                '/\{\w+(:([^}]+))?}/',
                fn() => '([A-Za-z0-9.-]+)',
                $this->_route
            )
            . "$@";
    }


    /**
     * Obter os parameters da rota
     *
     * @return array
     */
    private function _getRouteParams(): array
    {
        // Convert route name into regex pattern
        $routeRegex = $this->_getRouteRegex();
        // Test and match current route against $routeRegex
        if (preg_match_all($routeRegex, $this->_path, $valueMatches)) {
            $values = [];
            for ($i = 1, $iMax = count($valueMatches); $i < $iMax; $i++) {
                $values[] = $valueMatches[$i][0];
            }
        }
        $qty = $values[0] ?? null;
        $from = $values[1] ?? null;
        $to = $values[2] ?? null;
        $rate = $values[3] ?? null;

        return [
            'qty' => $qty,
            'from' => $from,
            'to' => $to,
            'rate' => $rate,
        ];
    }

    /**
     * Encaminhar a requisição e resolver as funções das rotas
     *
     * @return void
     */
    public function resolve(): void
    {
        $path = $this->request->getPath();
        $this->_path = rtrim($path, '/');
        $this->_route = $this->_getRoute();
        $this->routeParams = $this->_getRouteParams();
    }

    /**
     * Validar se o parameter é invalido
     *
     * @param array $params Parâmetros da rota
     *
     * @return bool
     */
    public function checkIsParamNull(array $params): bool
    {
        $filteredParamsValues = [];
        foreach ($this->routeParams as $param => $value) {
            if (in_array($param, $params, true)) {
                $filteredParamsValues[] = $value;
            }
        }

        foreach ($filteredParamsValues as $value) {
            if ($value === null) {
                return true;
            }
        }
        return false;
    }


}
