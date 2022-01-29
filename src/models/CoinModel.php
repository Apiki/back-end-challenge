<?php

namespace App\models;

use Exception;

class CoinModel
{

    private float|null $amount;
    private string $currency;
    private string $symbol;

    /**
     * @param float|null $amount
     * @param string $currency
     * @throws Exception
     */
    public function __construct(float|null $amount, string $currency)
    {
        $this->amount = $amount;
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
            foreach (CoinSymbolEnum::cases() as $cases) {
                if ($cases->name == $this->currency) {
                    $this->symbol = $cases->value;
                }
            }

            if (empty($this->symbol)) {
                throw new Exception('O valor de "currency" não está definido corretamente');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return float|null
     */
    public function getAmount(): float|null
    {
        return $this->amount;
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
