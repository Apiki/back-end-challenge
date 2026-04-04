<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Currency;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CurrencyTest extends TestCase
{
    #[DataProvider('symbolProvider')]
    public function testSymbolReturnsCorrectValue(
        Currency $currency,
        string $expected
    ): void {
        $this->assertSame($expected, $currency->symbol());
    }

    /**
     * @return array<string, array{Currency, string}>
     */
    public static function symbolProvider(): array
    {
        return [
            'BRL' => [Currency::BRL, 'R$'],
            'USD' => [Currency::USD, '$'],
            'EUR' => [Currency::EUR, '€'],
        ];
    }

    public function testTryFromValidCode(): void
    {
        $this->assertSame(Currency::BRL, Currency::tryFrom('BRL'));
        $this->assertSame(Currency::USD, Currency::tryFrom('USD'));
        $this->assertSame(Currency::EUR, Currency::tryFrom('EUR'));
    }

    public function testTryFromInvalidCodeReturnsNull(): void
    {
        $this->assertNull(Currency::tryFrom('GBP'));
        $this->assertNull(Currency::tryFrom('brl'));
        $this->assertNull(Currency::tryFrom(''));
    }
}
