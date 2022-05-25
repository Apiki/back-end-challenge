<?php
/**
 * This file is part of the Exchange Rate package, an API for managing
 *
 * @category Controllers.
 * @package  App\Controllers.
 * @author   Marcos Matos <marcosvm000@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     <https://www.linkedin.com/in/marcos-matos-47596a160/>
 */
namespace App\Model;

/**
 * Class Exchange.
 *
 * @category Controllers.
 * @package  App\Controllers.
 * @author   Marcos Matos <marcosvm000@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     <https://www.linkedin.com/in/marcos-matos-47596a160/>
 */
class Exchange
{
    /**
     *  Symbols of currencies.
     */
    const SYMBOLS = [
        'USD' => '$',
        'EUR' => '€',
        'BRL' => 'R$',
    ];

    /**
     * Amount of money to convert.
     *
     * @var
     */
    private  $_amount;

    /**
     * Currency to convert from.
     *
     * @var
     */
    private  $_coin_from;

    /**
     * Currency to convert to.
     *
     * @var
     */
    private  $_coin_to;

    /**
     * Rate of conversion.
     *
     * @var
     */
    private  $_rate;

    /**
     * Constructor.
     *
     * @param float  $_amount   Amount of money to convert.
     * @param string $coin_from Currency to convert from.
     * @param string $coin_to   Currency to convert to.
     * @param float  $rate      Rate of conversion.
     */
    public function __construct(
        float $_amount,
        string $coin_from,
        string $coin_to,
        float $rate
    ) {
        $this->setAmount($_amount);
        $this->setCoinFrom($coin_from);
        $this->setCoinTo($coin_to);
        $this->setRate($rate);
    }

    /**
     * Make the money conversion.
     *
     * @return array
     */
    public function makeConversion(): array
    {
        $new_amount = $this->getAmount() * $this->getRate();

        return $this->_makeResponse($new_amount);
    }


    /**
     * Make endpoint response.
     *
     * @param float $new_amount New amount of money.
     *
     * @return array
     */
    private function _makeResponse(float $new_amount): array
    {
        return [
            'valorConvertido' => $new_amount,
            'simboloMoeda' => self::SYMBOLS[$this->getCoinTo()],
        ];
    }

    /**
     * Get amount.
     *
     * @return mixed
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * Set amount.
     *
     * @param mixed $_amount Amount of money to convert.
     *
     * @return void
     */
    public function setAmount($_amount)
    {
        $this->_amount = $_amount;
    }

    /**
     * Get coin_from.
     *
     * @return mixed
     */
    public function getCoinFrom()
    {
        return $this->_coin_from;
    }

    /**
     * Set coin_from.
     *
     * @param mixed $coin_from Currency to convert from.
     *
     * @return void
     */
    public function setCoinFrom($coin_from)
    {
        $this->_coin_from = $coin_from;
    }

    /**
     * Get coin_to.
     *
     * @return mixed
     */
    public function getCoinTo()
    {
        return $this->_coin_to;
    }

    /**
     * Set coin_to.
     *
     * @param mixed $coin_to Currency to convert to.
     *
     * @return void
     */
    public function setCoinTo($coin_to)
    {
        $this->_coin_to = $coin_to;
    }

    /**
     * Get rate.
     *
     * @return mixed
     */
    public function getRate()
    {
        return $this->_rate;
    }

    /**
     * Set rate.
     *
     * @param mixed $rate Rate of conversion.
     *
     * @return void
     */
    public function setRate($rate)
    {
        $this->_rate = $rate;
    }

}
