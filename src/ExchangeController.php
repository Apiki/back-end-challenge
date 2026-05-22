<?php

declare(strict_types=1);

namespace App;

use Exception;
use InvalidArgumentException;

class ExchangeController
{
    private CurrencyConverter $converter;

    public function __construct()
    {
        $this->converter = new CurrencyConverter();
    }

    /**
     * Handles the conversion request and outputs the JSON response.
     *
     * @param mixed $amount
     * @param mixed $from
     * @param mixed $to
     * @param mixed $rate
     * @return void
     */
    public function convert($amount, $from, $to, $rate): void
    {
        try {
            // Validações básicas de formato numérico
            if (!is_numeric($amount) || !is_numeric($rate)) {
                throw new InvalidArgumentException('Amount and rate must be numeric values');
            }

            $amountFloat = (float) $amount;
            $rateFloat = (float) $rate;

            // Validações de valores de negócio (valores negativos ou zero para taxa)
            if ($amountFloat < 0) {
                throw new InvalidArgumentException('Amount must be a positive number');
            }

            if ($rateFloat <= 0) {
                throw new InvalidArgumentException('Rate must be greater than zero');
            }

            // Sanitização e formatação dos códigos de moeda
            $fromStr = strtoupper(trim((string) $from));
            $toStr = strtoupper(trim((string) $to));

            // Executa a conversão
            $result = $this->converter->convert($amountFloat, $fromStr, $toStr, $rateFloat);

            // Resposta de sucesso
            echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'error' => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
    }
}
