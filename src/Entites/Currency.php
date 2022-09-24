<?php
/**
 * File Currency.php /Entites
 *
 * PHP Version 8.0
 *
 * @category Entites
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace App\Entites;

/**
 * Currency Entity
 *
 * @category Entites
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
abstract class Currency
{

    protected float $amount = 0;
    protected string $symbol = '';
    
    /**
     * __construct
     *
     * @param mixed $amount of currency
     * 
     * @return void
     */
    function __construct( float $amount )
    {
        $this->amount = $amount;
    }

    
    /**
     * SetSymbol
     *
     * @param string $symbol set property
     * 
     * @return void
     */
    protected function setSymbol( string $symbol ) : void
    {
        $this->symbol = $symbol;
    }

    
    /**
     * SetAmount
     *
     * @param string $amount set property
     * 
     * @return void
     */
    protected function setAmount( float $amount ) : void
    {
        $this->amount = $amount;
    }    
    
    /**
     * GetSymbol return property
     *
     * @return string
     */
    public function getSymbol() : string
    {
        return $this->symbol;
    }
    
    /**
     * GetAmount return property
     *
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }
}