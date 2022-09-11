<?php
/**
 * Template File Doc Comment
 * 
 * PHP version 7.4
 *
 * @category Template_Class
 * @package  Template_Class
 * @author   Jhone Bering <jhonebering@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://localhost/
 */

 /**
  * Template Class Doc Comment
  *
  * PHP version 7.4
  *
  * Este arquivo tem o propósito criar um objeto 
  * modelo para as moedas.
  *
  * @category Challenge
  * @package  Back-end
  * @author   Jhone Bering <jhonebering@gmail.com>
  * @license  http://opensource.org/licenses/MIT MIT
  * @link     https://github.com/apiki/back-end-challenge
  */
class Currency
{
    private $_real = array( 
        "name" => "Real", 
        "code" => "BRL", 
        "value" => null, 
        "simbol" => 'R$'
    );
    private $_dolar = array(
        "name" => "Dólar", 
        "code" => "USD", 
        "value" => null, 
        "simbol" => '$'
    );
    private $_euro = array(
        "name" => "Euro", 
        "code" => "EUR", 
        "value" => null, 
        "simbol" => '€'  //€ = &#128
    );

    private $_currency;

    /**
     * Template Construct Doc Comment 
     * 
     * @param array $currency params to create a currency
     */
    function __construct($currency)
    {
        $this->_currencies = array(
            "BRL" => $this->_real,
            "USD" => $this->_dolar,
            "EUR" => $this->_euro,
        );

        if (is_null($this->_currencies[$currency])) {
            response(
                400, 'Bad Request', 
                $currency . ' is not a valid currency code.'
            );
            exit;
        }

        $this->_currency = $this->_currencies[$currency];
    }

    /**
     * Template Function Doc Comment 
     * 
     * Lista os valores atribuídos a moeda em _currency
     * 
     * @return array 
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * Template Function Doc Comment 
     * 
     * @param integer $value currency value
     * 
     * @return void 
     */
    public function setCurrency($value)
    {
        $this->_currency['value'] = floatval($value);
    }
}

?>