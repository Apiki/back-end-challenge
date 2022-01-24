<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrenciesRepository
{
    private $data;

    public function __construct()
    {
        $this->data = [
            'BRL' => new Currency('R$'),
            'EUR' => new Currency('€'),
            'USD' => new Currency('$')
        ];
    }

    public function getAll(): array
    {
        return array_values($this->data);
    }

    public function getByCode($code): ?Currency
    {
        return $this->data[$code] ?? null;
    }
}
