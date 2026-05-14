<?php

declare(strict_types=1);

namespace App;

/**
 * Performs currency conversion based on a validated ExchangeInput.
 *
 * Pure business logic — no validation, no I/O, no formatting.
 */
final class Exchange
{
    /** Monetary precision: 2 decimal places (cents). */
    private const PRECISION = 2;

    public function __construct(private readonly ExchangeInput $input)
    {
    }

    /**
     * Converts the amount using the provided rate as a direct multiplier.
     *
     * round() avoids floating-point representation drift
     * (e.g. 0.1 * 3 = 0.30000000000000004 in IEEE 754).
     */
    public function convert(): float
    {
        return round($this->input->amount * $this->input->rate, self::PRECISION);
    }

    /**
     * Returns the symbol of the target currency.
     */
    public function targetSymbol(): string
    {
        return $this->input->to->symbol();
    }

    /**
     * Returns the API response payload.
     *
     * @return array{valorConvertido: float, simboloMoeda: string}
     */
    public function toArray(): array
    {
        return [
            'valorConvertido' => $this->convert(),
            'simboloMoeda'    => $this->targetSymbol(),
        ];
    }
}
