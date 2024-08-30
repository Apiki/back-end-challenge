<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.1.28
 *
 * Controller criado para realizar as conversões  
 *
 * @category Challenge
 * @package  Back-end
 * @author   Hector Jaime Rondon Castillo <hecjairon@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class ExchangeController
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Hector Jaime Rondon Castillo <hecjairon@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 * */
class ExchangeController
{
    private $_currencySymbol = [];

    /**
     * Constructor de la clase ExchangeController.
     * 
     * Inicializa la configuración del símbolo de moneda.
     */
    public function __construct() 
    {
        $this->setCurrencySymbol();
    }
    /**
     * Exchange method
     *
     * @param array  $request name of the method and the class declaration 
     * @param int    $amount  Amount to exchange
     * @param string $from    Currency to exchange from
     * @param string $to      Currency to exchange to
     * @param float  $rate    Exchange rate
     *
     * @return Response
     */
    public function exchange(Array $request, $amount, $from, $to, $rate): Response
    {
        $arrayArg   = [ "amount"    => "required|number"   , 
                        "from"      => "required|length:3|in:_currencySymbol" , 
                        "to"        => "required|length:3|in:_currencySymbol" , 
                        "rate"      => "required|number"   ];
        foreach ($arrayArg as $nameVar => $valueArg) {
            $validation = $this->processValidate($valueArg, $$nameVar, $nameVar);
            if (!$validation['valid']) {
                return new JsonResponse(
                    ['data' => $validation, 'status' => 400],
                    400
                );
            }
        }
        $symbol         = $this->findCurrencySymbol($to);
        $convertedValue = $amount*$rate;
        $response       = ["valorConvertido" => $convertedValue, 
                            "simboloMoeda" => $symbol];
        return new JsonResponse($response, 200);
    }

    /**
     * ProcessValidate method
     * 
     * @param string $arg     string argument
     * @param mixed  $value   value parameter
     * @param string $nameVar name variable
     * 
     * @return Array
     */
    public function processValidate(
        string $arg, 
        mixed $value, 
        string $nameVar
    ): array {
        $arrayTypeValidated  = explode("|", $arg);
        foreach ($arrayTypeValidated as $keyType => $type) {
            $validated  = $this->validParameter($value, $type, $nameVar);
            if (!$validated['valid']) {
                return ["valid" => false, 
                        'type' => explode(":", $type)[0], 
                        'message' => $validated['message']];
            }
        }
        return ["valid" => true, 'type' => '', 'message' => 'valid'];
    }

    /**
     * ValidParameter method
     *
     * @param mixed  $value   code from currency
     * @param string $arg     string argument
     * @param string $nameVar string name var validated
     * 
     * @return Array 
     */
    public function validParameter($value, string $arg, string $nameVar) : array
    {
        $arrayArgType   = explode(":", $arg); 
        $type           = $arrayArgType[0];
        $args           = isset($arrayArgType[1]) ? $arrayArgType[1] : '';
        switch ($type) {
        case 'number':
            if (!is_numeric($value) || (float)$value <= 0) {
                return [
                    "valid" => false, 
                    'message' => "O campo '$nameVar' deve ser um Número válido!"
                ];
            }
            break;
        case 'required':
            if (empty($value) || is_null($value)) {
                return [
                    "valid" => false, 
                    'message' => "O campo '{$nameVar}' é obrigatório."
                ];
            }
            break;
        case 'length':
            if (strlen($value) != $args) {
                return [
                    "valid" => false, 
                    'message' => "O campo '$nameVar' deve ter $args caracteres."
                ];
            }
            break;
        case 'in':
            if (!isset($this->$args[$value])) {
                return [
                    "valid" => false, 
                    'message' => "O campo '{$nameVar}' deve ser válido."
                ];
            }
            break;
        default:
            return [
                "valid" => false, 
                'message' => "Error validação não registrada"
            ];
            break;
        }

        return ["valid" => true, 
                'message' => "Field validated"];

    }

    /**
     * SetCurrencySymbol method
     * 
     * @return void 
     */
    public function setCurrencySymbol() : void 
    {
        $this->_currencySymbol = [
            "USD"   => ["name" => "Dólar americano", 'symbol' => '$'],
            "BRL"   => ["name" => "Real brasileiro", 'symbol' => 'R$'],
            "EUR"   => ["name" => "Euro", 'symbol' => '€'], 
        ];
    }

    /**
     * FindCurrencySymbol method
     *
     * @param string $codeCurrency code from currency
     *
     * @return string
     */
    public function findCurrencySymbol($codeCurrency) : string 
    {
        return isset($this->_currencySymbol[$codeCurrency]['symbol']) 
            ? $this->_currencySymbol[$codeCurrency]['symbol'] 
            : null;
    }

}