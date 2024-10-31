<?php

use PHPUnit\Framework\TestCase;
use App\CurrencyConverter;

class ExchangeHandlerTest extends TestCase
{
    public function testConversaoBRLParaUSD()
    {
        $result = CurrencyConverter::convert(10, 'BRL', 'USD', 4.50);
        $this->assertEquals(['valorConvertido' => 2.22, 'simboloMoeda' => '$'], $result);
    }

    public function testConversaoUSDParaBRL()
    {
        $result = CurrencyConverter::convert(10, 'USD', 'BRL', 4.50);
        $this->assertEquals(['valorConvertido' => 45.00, 'simboloMoeda' => 'R$'], $result);
    }

    public function testConversaoBRLParaEUR()
    {
        $result = CurrencyConverter::convert(10, 'BRL', 'EUR', 5.00);
        $this->assertEquals(['valorConvertido' => 2.00, 'simboloMoeda' => '€'], $result);
    }

    public function testConversaoEURParaBRL()
    {
        $result = CurrencyConverter::convert(10, 'EUR', 'BRL', 5.00);
        $this->assertEquals(['valorConvertido' => 50.00, 'simboloMoeda' => 'R$'], $result);
    }

    public function testConversaoEURParaUSD()
    {
        $result = CurrencyConverter::convert(10, 'EUR', 'USD', 1.20);
        $this->assertEquals(['valorConvertido' => 12.00, 'simboloMoeda' => '$'], $result);
    }

    public function testConversaoUSDPraEUR()
    {
        $result = CurrencyConverter::convert(10, 'USD', 'EUR', 1.20);
        $this->assertEquals(['valorConvertido' => 8.33, 'simboloMoeda' => '€'], $result);
    }
}