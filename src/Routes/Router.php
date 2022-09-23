<?php

/**
 * Este é o arquivo de rotas.
 * 
 * PHP version 8.0.0
 *
 * @category Router
 * @package  Router
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

namespace App\Routes;

use App\Controller\ConvertController;
use App\Exception\BadRequestException;
use App\Validation\RouterValidation;

/**
 * Classe básica de rotas 
 * 
 * PHP version 8.0.0
 *
 * @category Router_Class
 * @package  Router_Class
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

class Router
{
    private string $_route;
    private string $_method;
    private object $_controller;
    private object $_routerValidation;

    /**
     * Construtor para tratar variáveis globais
     * e instanciar classes
     */
    public function __construct()
    {
        $this->_route            = $_SERVER['REQUEST_URI'];
        $this->_method           = $_SERVER['REQUEST_METHOD'];
        $this->_controller       = new ConvertController();
        $this->_routerValidation = new RouterValidation();
    }

    /**
     * Função com validação para uma rota específica:
     * Verbo HTTP: GET
     *
     * @return void
     */
    public function router(): void
    {
        try {
            if (strtolower($this->_method) !== 'get') {
                throw new BadRequestException();
            }

            $route = $this->_routerValidation->validation($this->_route);

            $this->_controller->convert($route[1], $route[2], $route[3], $route[4]);
        } catch (BadRequestException $error) {
            $error->badRequest();
        }
    }
}
