<?php

/**
 * This file is part of the API.
 *
 * @category Controllers.
 * @package  App\Controllers.
 * @author   Marcos Matos <marcosvm000@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     <https://www.linkedin.com/in/marcos-matos-47596a160/>
 */

namespace App\Controllers;

/**
 * Class to handle requests.
 *
 * @category Controllers.
 * @package  App\Controllers.
 * @author   Marcos Matos <marcosvm000@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     <https://www.linkedin.com/in/marcos-matos-47596a160/>
 */
class RequestController
{
    /**
     * Processes the request.
     *
     * @param array $request_params The request parameters.
     *
     * @return void
     */
    public function processRequest(array $request_params)
    {
        if ($request_params[1] !== 'exchange' || count($request_params) !== 6) {

            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid request'
                ]
            );
            http_response_code(400);
            exit;
        }

        if ($this->_validateAmount($request_params[2]) === false) {
            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid amount'
                ]
            );
            http_response_code(400);
            exit;
        }

        if ($this->_validateCurrency($request_params[3]) === false) {
            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid currency from'
                ]
            );
            http_response_code(400);
            exit;
        }

        if ($this->_validateCurrency($request_params[4]) === false) {
            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid currency to'
                ]
            );
            http_response_code(400);
            exit;
        }

        if ($this->_validateAmount($request_params[5]) === false) {
            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid rate'
                ]
            );
            http_response_code(400);
            exit;
        }

        $api_controller = new ApiController();

        $api_controller->processEndpoint($request_params);

    }

    /**
     *  Validates the amount.
     *
     * @param string $amount The amount.
     *
     * @return bool
     */
    private function _validateAmount(string $amount ): bool
    {
        if (!is_numeric($amount)) {
            return false;
        }
        if ($amount < 0) {
            return false;
        }
        return true;
    }

    /**
     * Validates the currency.
     *
     * @param string $currency The currency to validate.
     *
     * @return bool
     */
    private function _validateCurrency(string $currency): bool
    {
        if (!in_array($currency, ['USD', 'EUR', 'BRL'])) {
            return false;
        }
        return true;
    }

}