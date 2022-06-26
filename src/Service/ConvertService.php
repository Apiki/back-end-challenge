<?php

namespace App\Service;

use App\Helper\Helper;

class ConvertService extends Helper
{
    private array $coins = ['BRL', 'USD', 'EUR'];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $data
     * @return void
     */
    public function convertService(array $data): void
    {
        if(in_array($data['from'], $this->coins) && in_array($data['to'], $this->coins)) {
            $symbol = $this->returnSymbol($data['to']);
            if($this->checkValue($data['amount']) && $this->checkValue($data['rate'])) {
                $response = [
                    'valorConvertido' => $this->calculateExchange($data['amount'], $data['rate']),
                    'simboloMoeda' => $symbol
                ];
                $this->returnBack($response);
                exit;
            }
        }

        $this->calling(
            400,
            "not_found",
            "Valor incorreto"
        )->returnBack();
    }

    /**
     * @param $to
     * @return string
     */
    public function returnSymbol($to): string
    {
        return match ($to) {
            'EUR' => '€',
            'USD' => '$',
            default => 'R$',
        };
    }

    /**
     * @param $value
     * @return bool
     */
    public function checkValue($value): bool
    {
        if(preg_match('/^(\d+(\.\d+)?)$/', $value) > 0 && $value > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $amount
     * @param $rate
     * @return float|int
     */
    public function calculateExchange($amount, $rate): float|int
    {
        return ($amount * $rate);
    }
}