<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este arquivo contém a classe Router, utilizada para definir as rotas
 *
 * @category Router
 * @package  Utils
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */


namespace App\Utils;


/**
 * Classe Router
 * 
 * Classe utilizada para definir as rotas
 * 
 * @category Router
 * @package  Utils
 * @author   Raphael Ceccato Pauli <raphaelcpauli@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/raphaelceccato/back-end-challenge
 */
class Router
{
    private $_routes = [];


    /**
     * Define a callback para uma rota
     *
     * O padrão da rota deve ser uma string com uma expressão regular, e a função
     * de callback deve seguir o seguinte formato:
     * 
     * function callback(array $params) {}
     * 
     * A função de callback deve disparar uma exceção ControllerException caso
     * haja algum erro.
     * 
     * @param string   $pattern  O padrão da rota (uma string com uma expressão
     *                           regular)
     * @param callable $callback A callback da rota (uma função que recebe uma
     *                           array com os parâmetros
     *                           extraídos da URL, seguindo o padrão da rota).
     *                           Deve disparar uma exceção ControllerException
     *                           em caso de erro
     * 
     * @return void
     */
    public function get(string $pattern, callable $callback)
    {
        $this->_routes[$pattern] = $callback;
    }


    /**
     * Processa a requisição atual e executa o callback da rota correspondente,
     * se for encontrada. Deve ser chamada uma única vez por request
     *
     * @return bool Se uma rota correspondente foi encontrada
     */
    public function processRequest(): bool
    {
        $request = $_SERVER["REQUEST_URI"];

        $route_callback = null;
        $params = [];

        foreach ($this->_routes as $pattern => $callback) {
            $matches = [];
            if (preg_match($pattern, $request, $matches) > 0) {
                $route_callback = $callback;
                $params = $matches;
                break;
            }
        }

        if ($route_callback != null) {
            $route_callback($params);
        }

        return ($route_callback != null);
    }
}
