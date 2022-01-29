<?php

namespace App\models;

use Exception;

class CoinModel
{

    private float $amount;
    private string $currency;
    private string $symbol;

    /**
     * @param mixed $amount
     * @param string $currency
     * @throws Exception
     */
    public function __construct(string $amount, string $currency)
    {
        $this->amount = floatval($amount);
        $this->currency = $currency;
        $this->setSymbol();
    }

    /**
     * @param float $amount
     * @return void
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @param string $currency
     * @return void
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return void
     * @throws Exception
     */
    private function setSymbol(): void
    {
        try {
            if (!defined(CoinSymbolModel::class . "::" . $this->currency)) {
                throw new Exception('O valor de "currency" não está definido corretamente');
            }

            $this->symbol = constant(CoinSymbolModel::class . "::" . $this->currency);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount ?? 0.0;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }
}
