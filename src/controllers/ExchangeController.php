<?php

/**
 * Exchange controller.
 * 
 * PHP version 7.4 
 *
 * @category Challenge
 * @package  Back-end
 * @author   Leonardo Silva <leonardosilvadelima534@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

namespace App\Controllers;

use App\Services\CurrencyConverter;

/**
 * Controller for handling currency exchange requests.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Leonardo Silva <leonardosilvadelima534@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
final class ExchangeController
{
    private CurrencyConverter $_converter;

    /**
     * Initializes the controller with a currency converter instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_converter = new CurrencyConverter();
    }

    /**
     * Initializes the controller with a currency converter instance.
     *
     * @param array $params The parameters extracted from the route.
     * 
     * @return void
     */
    public function handle(array $params): void
    {
        if (count($params) !== 4) {
            $this->_respond(400, ['erro' => 'Parametros invalidos.']);
            return;
        }

        $amount   = $params['amount'];
        $from     = $params['from'];
        $to       = $params['to'];
        $rate   = $params['rate'];

        $amountOk = $this->_isPositiveNumber($amount);
        $rateOk = $this->_isPositiveNumber($rate);
        if (!$amountOk || !$rateOk) {
            $this->_respond(400, ['erro' => 'Valor ou taxa invalidos.']);
            return;
        }

        $fromOk = $this->_isValidCurrency($from);
        $toOk = $this->_isValidCurrency($to);
        if (!$fromOk || !$toOk) {
            $this->_respond(400, ['erro' => 'Moeda invalida.']);
            return;
        }

        if (!$this->_converter->canConvert($from, $to)) {
            $this->_respond(400, ['erro' => 'Conversao nao suportada.']);
            return;
        }

        $response = $this->_converter->convert(
            (float) $amount,
            $to,
            (float) $rate
        );
        $this->_respond(200, $response);
    }

    /**
     * Checks if a value is a positive number.
     *
     * @param string $value The value to check.
     *
     * @return bool
     */
    private function _isPositiveNumber(string $value): bool
    {
        return is_numeric($value) && (float) $value > 0;
    }

    /**
     * Processes a currency exchange request.
     *
     * @param string $currency The currency to convert.
     *
     * @return bool
     */
    private function _isValidCurrency(string $currency): bool
    {
        return in_array($currency, ['BRL', 'USD', 'EUR'], true);
    }

    /**
     * Sends a JSON response with the given status code and data.
     *
     * @param int   $statusCode The HTTP status code to send.
     * @param array $data       The data to include in the response body.
     *
     * @return void
     */
    private function _respond(int $statusCode, array $data): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
