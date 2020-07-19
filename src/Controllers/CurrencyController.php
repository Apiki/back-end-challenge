<?php

namespace App\Controllers;

use App\Objects\Currency;

class CurrencyController
{

    public static function currencyExchange(
        $amount,
        $from_currency,
        $to_currency,
        $rate
    ) {

        $errors = 0;
        $error_data = array();

        if (!is_numeric($amount) || self::isNegative($amount)) {
            $errors++;
            $error_data['errors'][$errors] = 'Favor utilizar apenas números positivos para o valor a ser convertido';
        }

        if (!is_numeric($rate) || self::isNegative($rate)) {
            $errors++;
            $error_data['errors'][$errors] = 'Favor utilizar apenas números positivos para a taxa da moeda de conversão';
        }

        if (!$errors) {
            //Create "from" Currency Object
            $actual_currency = new Currency($from_currency, $amount);

            if (!$actual_currency->getSign()) {
                $errors++;
                $error_data['errors'][$errors] = 'Favor utilizar apenas as moedas BRL, USD ou EUR';
            }

            //Calculate the exchange
            $calc_exchange = $actual_currency->getValue() * $rate;

            $result_currency = new Currency($to_currency, $calc_exchange);

            if (!$result_currency->getSign()) {
                $errors++;
                $error_data['errors'][$errors] = 'Favor utilizar apenas as moedas BRL, USD ou EUR para conversão';
            }

            //If variables are ok, return the exchange with no errors message
            if (!$errors) {
                $return = array(
                'valorConvertido'=>$result_currency->getValue(),
                'simboloMoeda'=>$result_currency->getSign()
                );
            } else {
                http_response_code(400);
                $return = $error_data;
            }
        } else {
            http_response_code(400);
            $return = $error_data;
        }

        echo json_encode($return, JSON_UNESCAPED_UNICODE);
    }

    private static function isNegative($number)
    {
        $return = false;
        if ($number < 0) {
            $return = true;
        }
        return $return;
    }


}
