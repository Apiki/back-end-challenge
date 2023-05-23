<?php

require_once __DIR__ . '/../src/CurrencyConverter.php';
use PHPUnit\Framework\TestCase;
use Currency\CurrencyConverter;
use InvalidArgumentException;

final class CurrencyConverterTest extends TestCase
{
    public function testConversionBRLtoUSD(): void
    {
        $converter = new CurrencyConverter(10, 'BRL', 'USD', 0.20);
        $result = $converter->convert();
        $this->assertEquals(2, $result['valorConvertido']);
        $this->assertEquals('$', $result['simboloMoeda']);
    }   

    public function testConversionUSDtoBRL(): void
    {
        $converter = new CurrencyConverter(10, 'USD', 'BRL', 5);
        $result = $converter->convert();
        $this->assertEquals(50, $result['valorConvertido']);
        $this->assertEquals('R$', $result['simboloMoeda']);
    }

    public function testConversionBRLtoEUR(): void
    {
        $converter = new CurrencyConverter(10, 'BRL', 'EUR', 0.17);
        $result = $converter->convert();
        $this->assertEqualsWithDelta(1.7, $result['valorConvertido'], 0.00001);
        $this->assertEquals('€', $result['simboloMoeda']);
    }

    public function testConversionEURtoBRL(): void
    {
        $converter = new CurrencyConverter(10, 'EUR', 'BRL', 5.88);
        $result = $converter->convert();
        $this->assertEquals(58.8, $result['valorConvertido']);
        $this->assertEquals('R$', $result['simboloMoeda']);
    }  

    public function testInvalidCurrency(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $converter = new CurrencyConverter(10, 'XYZ', 'BRL', 5.88);
        $converter->convert();
    }

    public function testInvalidRate(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $converter = new CurrencyConverter(10, 'EUR', 'BRL', 'invalid');
        $converter->convert();
    }
}
