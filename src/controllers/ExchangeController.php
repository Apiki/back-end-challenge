<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Maurício Silva <mauriciof.silva@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */ 
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use App\Helpers\CurrencyConverter;

/**
 * Classe que recebe as requisições de endpoints
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Maurício Silva <mauriciof.silva@gmail.com>
 * @license  http://opensource.org/licens/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge 
 */
class ExchangeController
{
    /**
     * Método que recebe a requisição e envia para a conversão de valores
     * 
     * @param Request  $request  parâmetro que traz a requisição do endpoint
     * @param Response $response parâmetro de retorno para o endpoint
     * 
     * @return $response
     */
    public function exchange(Request $request, Response $response)
    {
        /**
         * Parâmetro que recebe o resultado da conversão
         * 
         * @param conversao
         */
        $conversao = CurrencyConverter::transformValue($request, $response);
        if ($conversao) {
            $response->getBody()->write($conversao);
            $response = $response
                ->withHeader('Content-Type', 'application/json;charset=utf-8');
            return $response;
        }

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(400);
    }
}
