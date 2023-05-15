<?php

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testExchangeEndpoint()
    {
        // Simula uma requisição GET para a URL de alteração de moeda
        $url = 'http://localhost:8000/exchange/10/BRL/USD/4.50';
        $response = file_get_contents($url);

        // Verifica se o retorno é um JSON válido
        $decodedResponse = json_decode($response, true);
        $this->assertNotNull($decodedResponse);
        $this->assertJson($response);

        // Verifica se os campos esperados estão presentes no retorno
        $this->assertArrayHasKey('valorConvertido', $decodedResponse);
        $this->assertArrayHasKey('simboloMoeda', $decodedResponse);
    }
}
