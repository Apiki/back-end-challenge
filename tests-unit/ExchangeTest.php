<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Currency;
use App\Exchange;
use App\ExchangeInput;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Exchange
 */
final class ExchangeTest extends TestCase
{
    private function makeInput(
        float $amount,
        Currency $from,
        Currency $to,
        float $rate
    ): ExchangeInput {
        return new ExchangeInput($amount, $from, $to, $rate);
    }

    // ---------------------------------------------------------------
    // Conversion results — matching the ApiCest integration tests
    // ---------------------------------------------------------------

    public function testBrlToUsdConversion(): void
    {
        $exchange = new Exchange($this->makeInput(7.8, Currency::BRL, Currency::USD, 0.5));

        $this->assertSame(3.9, $exchange->convert());
    }

    public function testUsdToBrlConversion(): void
    {
        $exchange = new Exchange($this->makeInput(7.0, Currency::USD, Currency::BRL, 0.5));

        $this->assertSame(3.5, $exchange->convert());
    }

    public function testBrlToEurConversion(): void
    {
        $exchange = new Exchange($this->makeInput(7.0, Currency::BRL, Currency::EUR, 5.0));

        $this->assertSame(35.0, $exchange->convert());
    }

    public function testEurToBrlConversion(): void
    {
        $exchange = new Exchange($this->makeInput(7.0, Currency::EUR, Currency::BRL, 5.0));

        $this->assertSame(35.0, $exchange->convert());
    }

    // ---------------------------------------------------------------
    // Floating-point precision
    // ---------------------------------------------------------------

    public function testConversionRoundsToTwoDecimalPlaces(): void
    {
        // 10 * 3.333 = 33.33 (not 33.330000000000002)
        $exchange = new Exchange($this->makeInput(10.0, Currency::BRL, Currency::USD, 3.333));

        $this->assertSame(33.33, $exchange->convert());
    }

    public function testConversionHandlesFloatingPointImprecision(): void
    {
        // 0.1 + 0.2 = 0.30000000000000004 in IEEE 754 — round() fixes it
        $exchange = new Exchange($this->makeInput(0.1, Currency::BRL, Currency::USD, 3.0));

        $this->assertSame(0.3, $exchange->convert());
    }

    // ---------------------------------------------------------------
    // Target symbol
    // ---------------------------------------------------------------

    public function testTargetSymbolForUsd(): void
    {
        $exchange = new Exchange($this->makeInput(10.0, Currency::BRL, Currency::USD, 0.5));

        $this->assertSame('$', $exchange->targetSymbol());
    }

    public function testTargetSymbolForBrl(): void
    {
        $exchange = new Exchange($this->makeInput(10.0, Currency::USD, Currency::BRL, 5.0));

        $this->assertSame('R$', $exchange->targetSymbol());
    }

    public function testTargetSymbolForEur(): void
    {
        $exchange = new Exchange($this->makeInput(10.0, Currency::BRL, Currency::EUR, 0.2));

        $this->assertSame('€', $exchange->targetSymbol());
    }

    // ---------------------------------------------------------------
    // toArray — API response shape
    // ---------------------------------------------------------------

    public function testToArrayHasCorrectKeys(): void
    {
        $exchange = new Exchange($this->makeInput(7.8, Currency::BRL, Currency::USD, 0.5));
        $result   = $exchange->toArray();

        $this->assertArrayHasKey('valorConvertido', $result);
        $this->assertArrayHasKey('simboloMoeda', $result);
        $this->assertCount(2, $result);
    }

    public function testToArrayMatchesBrlToUsdExpectedOutput(): void
    {
        $exchange = new Exchange($this->makeInput(7.8, Currency::BRL, Currency::USD, 0.5));

        $this->assertSame(
            ['valorConvertido' => 3.9, 'simboloMoeda' => '$'],
            $exchange->toArray()
        );
    }

    public function testToArrayMatchesEurToBrlExpectedOutput(): void
    {
        $exchange = new Exchange($this->makeInput(7.0, Currency::EUR, Currency::BRL, 5.0));

        $this->assertSame(
            ['valorConvertido' => 35.0, 'simboloMoeda' => 'R$'],
            $exchange->toArray()
        );
    }
}
