<?php

namespace App\Model;

/**
 *
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
     * USD Currency value.
     */
    const USD_TO_BRL = 4.82;

    /**
     * EUR Currency value.
     */
    CONST EUR_TO_BRL = 5.17;

    /**
     * Amount of money to convert.
     *
     * @var
     */
    private  $amount;

    /**
     * Currency to convert from.
     *
     * @var
     */
    private  $coin_from;

    /**
     * Currency to convert to.
     *
     * @var
     */
    private  $coin_to;

    /**
     * Rate of conversion.
     *
     * @var
     */
    private  $rate;

    /**
     * @param float $amount Amount of money to convert.
     * @param string $coin_from Currency to convert from.
     * @param string  Currency to convert to.
     * @param float $rate Rate of conversion.
     */
    public function __construct(float $amount, string $coin_from, string $coin_to, float $rate)
    {
        $this->setAmount($amount);
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
        $new_amount = $this->getAmount() - $this->getRate();

        switch ($this->getCoinTo()) {
            case 'USD':
                $new_amount = $this->convertToUSD($new_amount);
                break;
            case 'EUR':
                $new_amount = $this->convertToEUR($new_amount);
                break;
            case 'BRL':
                $new_amount  = $this->convertToBRL($new_amount);
                break;
        }

        return $this->makeResponse($new_amount);
    }

    /**
     * Convert to BRL.
     *
     * @param float $new_amount New amount of money to convert.
     * @return float
     */
    private function convertToBRL(float $new_amount): float
    {
        if ('USD' === $this->getCoinFrom()) {

            $new_amount = $new_amount * self::USD_TO_BRL;

        }elseif('EUR' === $this->getCoinFrom()) {

            $new_amount = $new_amount * self::EUR_TO_BRL;

        }

        return $new_amount;
    }

    /**
     * Convert to USD.
     *
     * @param float $amount Amount of money to convert.
     * @return float
     */
    private function convertToUSD(float $amount): float
    {
        if ('BRL' === $this->getCoinFrom()) {

            $amount = $amount / self::USD_TO_BRL;

        }

        return $amount;
    }

    /**
     * Convert to EUR.
     *
     * @param float $amount Amount of money to convert.
     * @return float
     */
    private function convertToEUR(float $amount): float
    {
        if ('BRL' === $this->getCoinFrom()) {

            $amount = $amount / self::EUR_TO_BRL;

        }

        return $amount;
    }

    /**
     * Make endpoint response.
     *
     * @param float $new_amount New amount of money.
     * @return array
     */
    private function makeResponse(float $new_amount): array
    {
        return [
            'valorConvertido' => (int) $new_amount,
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
        return $this->amount;
    }

    /**
     * Set amount.
     *
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get coin_from.
     *
     * @return mixed
     */
    public function getCoinFrom()
    {
        return $this->coin_from;
    }

    /**
     * Set coin_from.
     *
     * @param mixed $coin_from
     */
    public function setCoinFrom($coin_from)
    {
        $this->coin_from = $coin_from;
    }

    /**
     * Get coin_to.
     *
     * @return mixed
     */
    public function getCoinTo()
    {
        return $this->coin_to;
    }

    /**
     * Set coin_to.
     *
     * @param mixed $coin_to
     */
    public function setCoinTo($coin_to)
    {
        $this->coin_to = $coin_to;
    }

    /**
     * Get rate.
     *
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set rate.
     *
     * @param mixed $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

}