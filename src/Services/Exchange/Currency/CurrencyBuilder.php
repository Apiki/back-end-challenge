<?php
/**
 * File CurrencyBuilder.php /Services/Exchange/Currency
 *
 * PHP Version 8.0
 *
 * @category Services_Exchange_Currency
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace App\Services\Exchange\Currency;
use App\Entites\Currency;

/**
 * Service ExchangeRequest route
 *
 * @category Services_Exchange_Currency
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class CurrencyBuilder
{

    private $_currencies = [
        'BRL' => BRL::class,
        'USD' => USD::class,
        'EUR' => EUR::class,
    ];
    
    /**
     * Build return Currency class
     *
     * @param string $currencyName currency abbreviation
     * @param float  $amount       number
     * 
     * @return Currency
     */
    public function build( string $currencyName, float $amount ) : Currency
    {
        $currency = $this->_currencies[ $currencyName ];   
        $object = new $currency($amount);

        return new $currency($amount);
    }
}