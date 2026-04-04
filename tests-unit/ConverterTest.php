<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Converter;
use App\Currency;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ConverterTest extends TestCase
{
    #[DataProvider('conversionProvider')]
    public function testConvertReturnsExpectedResult(
        float $amount,
        Currency $to,
        float $rate,
        float $expectedValue,
        string $expectedSymbol
    ): void {
        $result = Converter::convert($amount, $to, $rate);

        $this->assertSame($expectedValue, $result['valorConvertido']);
        $this->assertSame($expectedSymbol, $result['simboloMoeda']);
    }

    /**
     * @return array<string, array{float, Currency, float, float, string}>
     */
    public static function conversionProvider(): array
    {
        return [
            'BRL to USD' => [7.8, Currency::USD, 0.5, 3.9, '$'],
            'USD to BRL' => [7.0, Currency::BRL, 0.5, 3.5, 'R$'],
            'BRL to EUR' => [7.0, Currency::EUR, 5.0, 35.0, '€'],
            'EUR to BRL' => [7.0, Currency::BRL, 5.0, 35.0, 'R$'],
        ];
    }
}
