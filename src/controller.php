<?php
/**
 * API main Controller
 * handles API logic
 *
 * PHP version 7.4
 *
 * @category Backend_Challenge
 * @package  Back-end-challenge
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/fabianoone/back-end-challenge
 */

 /**
  * Class Controller
  *
  * @category Backend_Challenge
  * @package  Back-end
  * @author   Fabiano Oliveira <fabiano.one@gmail.com>
  * @license  MIT http://opensource.org/licenses/MIT
  * @link     https://github.com/fabianoone/back-end-challenge
  */
class Controller
{
    /**
     * Receives and treat request method
     *
     * @param STRING $method within the url param
     * @param ARRAY  $data   args for the $method
     *
     * @return ARRAY Array with results [result || error]
     */
    public function getRequest($method, $data)
    {
        if (method_exists($this, $method)) {
            return call_user_func(array($this, $method), $data);
        } else {
            return ['ERRO' => 'Method does not exist...'];
        }
    }

    /**
     * Exchange currencies
     *
     * @param ARRAY $data withi args $amount, $from, $to, $rate
     *
     * @return ARRAY array with exchange values
     * and currency symbols 'R$100'
     */
    private function _exchange($data)
    {
        @[$amount, $from, $to, $rate] = $data;
        if (!max($amount, 0) || !$from || !$to || !max($rate, 0)) {
            return ['ERRO' => 'Request error...'];
        }
        if ($from == 'BRL' || $to == 'BRL') {
            $convertedValue = $amount * $rate;
            $currencySymbol = '';
            switch ($to) {
            case 'BRL':
                $currencySymbol = 'R$';
                break;
            case 'EUR':
            case '€':
                $currencySymbol = '€';
                break;
            case 'USD':
                $currencySymbol = '$';
                break;
            default:
                return ['ERRO' => 'Currency not allowed.'];
                    break;
            }

            return [
                'valorConvertido' => $convertedValue,
                'simboloMoeda' => $currencySymbol
            ];
        } else {
            return ['ERRO' => 'Currency not allowed.'];
        }
    }
}
