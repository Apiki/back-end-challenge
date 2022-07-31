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
 * @author   Nick Granados <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */

namespace App;

/**
 * Class Router
 *
 * @category Router
 * @package  Back-end
 * @author   Nick Granados <internickbr@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/internick2017/back-end-challenge
 */
class Router
{
    /**
     * Rota Regex
     *
     * @var string|null
     */
    private ?string $_routeRegex;
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
        $this->_routeRegex = $this->_getRouteRegex();
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
                '/exchange/{amount}/{from}/{to}/{rate}'
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
        if (preg_match_all($this->_routeRegex, $this->_path, $valueMatches)) {
            $values = [];
            for ($i = 1, $iMax = count($valueMatches); $i < $iMax; $i++) {
                $values[] = $valueMatches[$i][0];
            }
        }

        return [
            'amount' => $values[0] ?? null,
            'from' => $values[1] ?? null,
            'to' => $values[2] ?? null,
            'rate' => $values[3] ?? null,
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
        $this->routeParams = $this->_getRouteParams();
    }

    /**
     * Validar se o rota é invalido
     *
     * @return bool
     */
    public function isValidRoute(): bool
    {
        foreach ($this->routeParams as $value) {
            if ($value === null) {
                return true;
            }
        }
        return false;
    }
}

