<?php

class ConversorMoedas
{
    private $currencySymbols = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€'
    ];
    private $allowedConversions = [
        'BRL' => ['USD', 'EUR'],
        'USD' => ['BRL'],
        'EUR' => ['BRL']
    ];

    public function convert($amount, $from, $to, $rate)
    {
        // Validação das moedas
        if (!isset($this->currencySymbols[$from]) || !isset($this->currencySymbols[$to])) {
            throw new InvalidArgumentException('Código de moeda inválido');
        }

        // Validação conversão permitida
        if (!in_array($to, $this->allowedConversions[$from])) {
            throw new InvalidArgumentException('Conversão não permitida');
        }

        // Calcular valor convertido
        $convertedValue = $amount * $rate;
        return [
            'valorConvertido' => round($convertedValue, 2),
            'simboloMoeda' => $this->currencySymbols[$to]
        ];
    }
}
