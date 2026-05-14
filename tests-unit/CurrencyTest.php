<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Currency;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Currency
 */
final class CurrencyTest extends TestCase
{
    // ---------------------------------------------------------------
    // fromCode — valid cases
    // ---------------------------------------------------------------

    public function testFromCodeReturnsBrl(): void
    {
        $currency = Currency::fromCode('BRL');

        $this->assertSame(Currency::BRL, $currency);
    }

    public function testFromCodeReturnsUsd(): void
    {
        $currency = Currency::fromCode('USD');

        $this->assertSame(Currency::USD, $currency);
    }

    public function testFromCodeReturnsEur(): void
    {
        $currency = Currency::fromCode('EUR');

        $this->assertSame(Currency::EUR, $currency);
    }

    // ---------------------------------------------------------------
    // fromCode — invalid cases
    // ---------------------------------------------------------------

    public function testFromCodeReturnsNullForUnknownCode(): void
    {
        $this->assertNull(Currency::fromCode('GBP'));
    }

    public function testFromCodeReturnsNullForLowercase(): void
    {
        $this->assertNull(Currency::fromCode('brl'));
    }

    public function testFromCodeReturnsNullForEmptyString(): void
    {
        $this->assertNull(Currency::fromCode(''));
    }

    public function testFromCodeReturnsNullForPartialCode(): void
    {
        $this->assertNull(Currency::fromCode('BR'));
    }

    // ---------------------------------------------------------------
    // symbol()
    // ---------------------------------------------------------------

    public function testBrlSymbol(): void
    {
        $this->assertSame('R$', Currency::BRL->symbol());
    }

    public function testUsdSymbol(): void
    {
        $this->assertSame('$', Currency::USD->symbol());
    }

    public function testEurSymbol(): void
    {
        $this->assertSame('€', Currency::EUR->symbol());
    }

    // ---------------------------------------------------------------
    // enum integrity
    // ---------------------------------------------------------------

    public function testExactlyThreeCurrenciesExist(): void
    {
        $this->assertCount(3, Currency::cases());
    }

    public function testAllCasesHaveNonEmptySymbol(): void
    {
        foreach (Currency::cases() as $currency) {
            $this->assertNotEmpty($currency->symbol());
        }
    }
}
