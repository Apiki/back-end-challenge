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

use Symfony\Component\Intl\Currencies;

/**
 * Classe que recebe as requisições de endpoints e efetua validação de valores
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Maurício Silva <mauriciof.silva@gmail.com>
 * @license  http://opensource.org/licens/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge 
 */
class ExchangeValidator
{
    /**
     * Método que recebe a requisição e efetua a validação de valores
     * 
     * @param Request  $request  parâmetro que traz a requisição do endpoint
     * @param Response $response parâmetro de retorno para o endpoint
     * 
     * @return $response
     */
    public static function validate($request, $response)
    {
        $error = 0;

        $isValidAmount = self::_validateValue($request->getAttribute('amount'));
        if ($isValidAmount !== true) {
            $error++;
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        $isValidFrom = self::_validateCurrency($request->getAttribute('from'));
        if ($isValidFrom !== true) {
            $error++;
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        $isValidTo = self::_validateCurrency($request->getAttribute('to'));
        if ($isValidTo !== true) {
            $error++;
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        $isValidRate = self::_validateValue($request->getAttribute('rate'));
        if ($isValidRate !== true) {
            $error++;
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        if ($error > 0) {
            $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    /**
     * Método que recebe o parâmetro e efetua a validação de valores
     * 
     * @param $value parâmetro de entrada para validação
     * 
     * @return bool
     */
    private static function _validateValue($value)
    {
        if (strpos($value, ',')) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }
        if (empty($value)  
            || null === $value  
            || !is_numeric($value)  
            || ($value < 0)
        ) {
            return false;
        }
        return true;
    }

    /**
     * Método que recebe o parâmetro e efetua a validação de tipo de moeda
     * 
     * @param $type parâmetro de entrada para validação
     * 
     * @return bool
     */
    private static function _validateCurrency($type)
    {
        if (!Currencies::exists($type)) {
            return false;
        }
        return true;
    }
}
