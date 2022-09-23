<?php

/**
 * Este será o arquivo de Exception adicionais.
 * 
 * PHP version 8.0.0
 *
 * @category Exception
 * @package  Exception
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

namespace App\Exception;

use Exception;

/**
 * Função para retornar uma resposta quando for bad request
 * 
 * PHP version 8.0.0
 *
 * @category Bad_Request_Exception_Class
 * @package  Bad_Request_Exception_Class
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

class BadRequestException extends Exception
{
    /**
     * Função para entregar uma resposta simplificada
     *
     * @return void
     */
    public function badRequest(): void
    {
        echo json_encode([]);
        http_response_code(400);
        exit;
    }
}
