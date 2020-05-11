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
namespace App\Helpers;

/**
 * Classe que recebe as requisições de endpoints e efetua validação de params
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Maurício Silva <mauriciof.silva@gmail.com>
 * @license  http://opensource.org/licens/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge 
 */
class ValidateEndpoint
{
    /**
     * Método que recebe a requisição e efetua a validação de params
     * 
     * @param Response $response parâmetro de retorno para o endpoint
     * 
     * @return $response
     */
    public static function routeHandler($response)
    {
        $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(400);
    }
}
