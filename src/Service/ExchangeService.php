<?php
declare(strict_types=1);
namespace App\Service;

use App\Domain\Currency;

class ExchangeService
{
    public function convert(float $amount, string $from, string $to, float $rate): ?array
    {
        if (!$this->isSupportedConversion($from, $to)) {
            return null;
        }

        return [
            'valorConvertido' => $amount * $rate,
            'simboloMoeda' => Currency::getSymbol($to),
        ];
    }

    private function isSupportedConversion(string $from, string $to): bool
    {
        $supportedConversions = [
            Currency::BRL . '-' . Currency::USD,
            Currency::USD . '-' . Currency::BRL,
            Currency::BRL . '-' . Currency::EUR,
            Currency::EUR . '-' . Currency::BRL,
        ];

        return in_array($from . '-' . $to, $supportedConversions, true);
    }
}