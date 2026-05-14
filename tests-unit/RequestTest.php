<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Currency;
use App\ExchangeException;
use App\ExchangeInput;
use App\Request;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Request
 */
final class RequestTest extends TestCase
{
    // ---------------------------------------------------------------
    // Route prefix
    // ---------------------------------------------------------------

    public function testEmptyUriThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/'))->parse();
    }

    public function testMissingExchangePrefixThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/10/BRL/USD/0.5'))->parse();
    }

    public function testWrongPrefixThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/convert/10/BRL/USD/0.5'))->parse();
    }

    // ---------------------------------------------------------------
    // Segment count
    // ---------------------------------------------------------------

    public function testOnlyPrefixThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange'))->parse();
    }

    public function testMissingFromThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10'))->parse();
    }

    public function testMissingToThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/BRL'))->parse();
    }

    public function testMissingRateThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/BRL/USD'))->parse();
    }

    public function testExtraSegmentsThrow(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/BRL/USD/0.5/extra'))->parse();
    }

    // ---------------------------------------------------------------
    // Amount
    // ---------------------------------------------------------------

    public function testAlphaAmountThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/abc/BRL/USD/0.5'))->parse();
    }

    public function testNegativeAmountThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/-10/BRL/USD/0.5'))->parse();
    }

    public function testZeroAmountThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/0/BRL/USD/0.5'))->parse();
    }

    // ---------------------------------------------------------------
    // Currency (case-sensitive)
    // ---------------------------------------------------------------

    public function testLowercaseFromThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/brl/USD/0.5'))->parse();
    }

    public function testLowercaseToThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/BRL/usd/0.5'))->parse();
    }

    public function testUnknownCurrencyFromThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/GBP/USD/0.5'))->parse();
    }

    public function testUnknownCurrencyToThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/BRL/GBP/0.5'))->parse();
    }

    // ---------------------------------------------------------------
    // Rate
    // ---------------------------------------------------------------

    public function testAlphaRateThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/BRL/USD/abc'))->parse();
    }

    public function testNegativeRateThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/BRL/USD/-0.5'))->parse();
    }

    public function testZeroRateThrows(): void
    {
        $this->expectException(ExchangeException::class);
        (new Request('/exchange/10/BRL/USD/0'))->parse();
    }

    // ---------------------------------------------------------------
    // Valid inputs
    // ---------------------------------------------------------------

    public function testValidIntegerAmountReturnsInput(): void
    {
        $input = (new Request('/exchange/10/BRL/USD/0.5'))->parse();

        $this->assertInstanceOf(ExchangeInput::class, $input);
        $this->assertSame(10.0, $input->amount);
        $this->assertSame(Currency::BRL, $input->from);
        $this->assertSame(Currency::USD, $input->to);
        $this->assertSame(0.5, $input->rate);
    }

    public function testValidDecimalAmountReturnsInput(): void
    {
        $input = (new Request('/exchange/7.8/BRL/USD/0.5'))->parse();

        $this->assertSame(7.8, $input->amount);
        $this->assertSame(0.5, $input->rate);
    }

    public function testQueryStringIsIgnored(): void
    {
        $input = (new Request('/exchange/10/BRL/USD/0.5?debug=1'))->parse();

        $this->assertSame(10.0, $input->amount);
        $this->assertSame(0.5, $input->rate);
    }

    public function testAllSupportedCurrenciesParseCorrectly(): void
    {
        $combinations = [
            ['/exchange/7/BRL/USD/0.5', Currency::BRL, Currency::USD],
            ['/exchange/7/BRL/EUR/5',   Currency::BRL, Currency::EUR],
            ['/exchange/7/USD/BRL/0.5', Currency::USD, Currency::BRL],
            ['/exchange/7/EUR/BRL/5',   Currency::EUR, Currency::BRL],
        ];

        foreach ($combinations as [$uri, $expectedFrom, $expectedTo]) {
            $input = (new Request($uri))->parse();
            $this->assertSame($expectedFrom, $input->from);
            $this->assertSame($expectedTo, $input->to);
        }
    }
}
