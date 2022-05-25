<?php

namespace App\Controllers;

/**
 * Class to handle requests.
 */
class RequestController
{
    /**
     * Processes the request.
     *
     * @param array $request_params The request parameters.
     * @return void
     */
    public function processRequest(array $request_params)
    {
        if ($request_params[1] !== 'exchange' || count($request_params) !== 6) {

            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid request'
                ]);
            exit;
        }

        if ($this->validateAmount($request_params[2]) === false) {
            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid amount'
                ]);
            exit;
        }

        if ($this->validateCurrency($request_params[3]) === false) {
            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid currency from'
                ]);
            exit;
        }

        if ($this->validateCurrency($request_params[4]) === false) {
            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid currency to'
                ]);
            exit;
        }

        if($this->validateAmount($request_params[5]) === false) {
            echo \GuzzleHttp\json_encode(
                [
                    'Error' => 'Invalid rate'
                ]);
            exit;
        }

        $api_controller = new ApiController();

        $api_controller->processEndpoint($request_params);

    }

    /**
     *  Validates the amount.
     *
     * @param string $amount The amount.
     * @return bool
     */
    private function validateAmount(string $amount ): bool
    {
        if (!is_numeric( $amount )) {
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
     * @return bool
     */
    private function validateCurrency(string $currency): bool
    {
        if (!in_array($currency, ['USD', 'EUR', 'BRL'])) {
            return false;
        }
        return true;
    }

}