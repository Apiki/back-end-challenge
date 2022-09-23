<?php

/**
 * Este será o arquivo para validação de rotas.
 * 
 * PHP version 8.0.0
 *
 * @category Validation
 * @package  Validation
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

namespace App\Validation;

use App\Exception\BadRequestException;

/**
 * Classe de validação e tratamento de erro na rotas.
 * 
 * PHP version 8.0.0
 *
 * @category Router_Validation_Class
 * @package  Router_Validation_Class
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

class RouterValidation
{
    /**
     * Função para validar os parâmetros de rota
     *
     * @param string $route route params
     * 
     * @return array;
     * @throws \BadRequestException Bad requests.
     */
    public function validation($route)
    {
        $route = ltrim($route, '/');
        $routeParams = explode('/', $route);

        if (count($routeParams) !== 5) {
            throw new BadRequestException();
        }

        if ($routeParams[0] !== 'exchange') {
            throw new BadRequestException();
        }

        return $routeParams;
    }
}
