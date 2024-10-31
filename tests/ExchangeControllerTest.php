<?php

use PHPUnit\Framework\TestCase;
use App\ExchangeController;

require_once __DIR__ . '/../src/ExchangeController.php';

class ExchangeControllerTest extends TestCase
{
    public function testConversionBRLToUSD() {
        $controller = new ExchangeController();
        $result = $controller->convert(10, 'BRL', 'USD', 4.5);
        $this->assertEquals(45, $result['valorConvertido']);
        $this->assertEquals('$', $result['simboloMoeda']);
    }

    public function testConversionUSDToBRL() {
        $controller = new ExchangeController();
        $result = $controller->convert(10, 'USD', 'BRL', 0.2);
        $this->assertEquals(2, $result['valorConvertido']);
        $this->assertEquals('R$', $result['simboloMoeda']);
    }

    public function testConversionBRLToEUR() {
        $controller = new ExchangeController();
        $result = $controller->convert(10, 'BRL', 'EUR', 5.0);
        $this->assertEquals(50, $result['valorConvertido']);
        $this->assertEquals('€', $result['simboloMoeda']);
    }

    public function testConversionEURToBRL() {
        $controller = new ExchangeController();
        $result = $controller->convert(10, 'EUR', 'BRL', 0.2);
        $this->assertEquals(2, $result['valorConvertido']);
        $this->assertEquals('R$', $result['simboloMoeda']);
    }

    public function testInvalidCurrency() {
        $this->expectException(Exception::class);
        $controller = new ExchangeController();
        $controller->convert(10, 'BRL', 'INVALID', 4.5);
    }
}
