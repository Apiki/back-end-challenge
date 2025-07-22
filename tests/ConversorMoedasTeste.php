<?php
require __DIR__ . '/../src/ConversorMoedas.php';

use PHPUnit\Framework\TestCase;

class ConversorMoedasTeste extends TestCase {
    private $converter;

    protected function setUp(): void {
        $this->converter = new ConversorMoedas();
    }

    // Teste de conversão BRL para USD
    public function testeBRLpraUSDConvertido() {
        $result = $this->converter->convert(10, 'BRL', 'USD', 4.50);
        $this->assertEquals(45, $result['valorConvertido']);
        $this->assertEquals('$', $result['simboloMoeda']);
    }

    // Teste de conversão USD para BRL
    public function testeUSDpraBRLConvertido() {
        $result = $this->converter->convert(15, 'USD', 'BRL', 0.22);
        $this->assertEquals(3.3, $result['valorConvertido']);
        $this->assertEquals('R$', $result['simboloMoeda']);
    }

    // Teste de conversão BRL para EUR
    public function testeBRLpraEURConvertido() {
        $result = $this->converter->convert(20, 'BRL', 'EUR', 5.40);
        $this->assertEquals(108, $result['valorConvertido']);
        $this->assertEquals('€', $result['simboloMoeda']);
    }

    // Teste de moeda inválida
    public function testeInvalidoConversor() {
        $this->expectException(InvalidArgumentException::class);
        $this->converter->convert(10, 'BRL', 'JPY', 4.50);
    }

    // Teste de conversão não permitida
    public function testeNaoPermitidoConverter() {
        $this->expectException(InvalidArgumentException::class);
        $this->converter->convert(10, 'USD', 'EUR', 0.85);
    }

    // Teste com valores decimais
    public function testeDecimalValores() {
        $result = $this->converter->convert(7.5, 'BRL', 'USD', 4.50);
        $this->assertEquals(33.75, $result['valorConvertido']);
    }
}