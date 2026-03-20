<?php
declare(strict_types=1);

namespace App\Validation;

use App\Domain\Currency;

class ExchangeRequestValidator
{
    public function  validate(array $segments): array
    {
        $segments = array_values(
            array_filter(
                array_map(
                    static function ($segment): string {
                        return trim((string) $segment);
                    },
                    $segments
                ),
                static function (string $segment): bool {
                    return $segment !== '';
                }
            )
        );

        if (count($segments) !== 4) {
            return [
                'valid' => false,
                'message' => 'Invalid route parameters.',
                'debug' => $segments,
                'count' => count($segments),
            ];
        }

        [$amount, $from, $to, $rate] = $segments;

        if (!$this->isValidPositiveNumber($amount)) {
            return [
                'valid' => false,
                'message' => 'Invalid amount.',
                'debug' => $segments,
            ];
        }

        if (!$this->isValidCurrency($from)) {
            return [
                'valid' => false,
                'message' => 'Invalid source currency.',
                'debug' => $segments,
            ];
        }

        if (!$this->isValidCurrency($to)) {
            return [
                'valid' => false,
                'message' => 'Invalid target currency.',
                'debug' => $segments,
            ];
        }

        if (!$this->isValidPositiveNumber($rate)) {
            return [
                'valid' => false,
                'message' => 'Invalid rate.',
                'debug' => $segments,
            ];
        }

        return [
            'valid' => true,
            'segments' => $segments,
        ];
    }

    private function isValidPositiveNumber(string $value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        return (float) $value > 0;
    }

    private function isValidCurrency(string $currency): bool
    {
        if (!preg_match('/^[A-Z]{3}$/', $currency)) {
            return false;
        }

        return Currency::isSupported($currency);
    }
}