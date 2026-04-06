<?php
/**
 * Exchange request value object.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

namespace App\Exchange;

/**
 * Exchange request value object.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
class ExchangeRequest
{
    private float $_amount;

    private string $_from;

    private string $_to;

    private float $_rate;

    /**
     * Create a new exchange request.
     *
     * @param float  $amount Exchange amount.
     * @param string $from   Source currency.
     * @param string $to     Target currency.
     * @param float  $rate   Exchange rate.
     */
    public function __construct(float $amount, string $from, string $to, float $rate)
    {
        $this->_amount = $amount;
        $this->_from = $from;
        $this->_to = $to;
        $this->_rate = $rate;
    }

    /**
     * Return the exchange amount.
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->_amount;
    }

    /**
     * Return the source currency.
     *
     * @return string
     */
    public function getFrom(): string
    {
        return $this->_from;
    }

    /**
     * Return the target currency.
     *
     * @return string
     */
    public function getTo(): string
    {
        return $this->_to;
    }

    /**
     * Return the exchange rate.
     *
     * @return float
     */
    public function getRate(): float
    {
        return $this->_rate;
    }
}
