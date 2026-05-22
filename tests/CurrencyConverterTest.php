<?php

use App\CurrencyConverter;
use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    private CurrencyConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new CurrencyConverter();
    }

    // Teste de conversão BRL para USD
    public function testBRLtoUSDConversion() {
        $result = $this->converter->convert(10, 'BRL', 'USD', 4.50);
        $this->assertEquals(45, $result['valorConvertido']);
        $this->assertEquals('$', $result['simboloMoeda']);
    }

    // Teste de conversão USD para BRL
    public function testUSDtoBRLConversion() {
        $result = $this->converter->convert(15, 'USD', 'BRL', 0.22);
        $this->assertEquals(3.3, $result['valorConvertido']);
        $this->assertEquals('R$', $result['simboloMoeda']);
    }

    // Teste de conversão BRL para EUR
    public function testBRLtoEURConversion() {
        $result = $this->converter->convert(20, 'BRL', 'EUR', 5.40);
        $this->assertEquals(108, $result['valorConvertido']);
        $this->assertEquals('€', $result['simboloMoeda']);
    }

    // Teste de moeda inválida
    public function testInvalidCurrency() {
        $this->expectException(InvalidArgumentException::class);
        $this->converter->convert(10, 'BRL', 'JPY', 4.50);
    }

    // Teste de conversão não permitida
    public function testNotAllowedConversion() {
        $this->expectException(InvalidArgumentException::class);
        $this->converter->convert(10, 'USD', 'EUR', 0.85);
    }

    // Teste com valores decimais
    public function testDecimalValues() {
        $result = $this->converter->convert(7.5, 'BRL', 'USD', 4.50);
        $this->assertEquals(33.75, $result['valorConvertido']);
    }
}