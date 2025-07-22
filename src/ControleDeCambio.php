<?php

require __DIR__ . '/ConversorMoedas.php';

class ControleDeCambio
{
    private $converter;

    public function __construct()
    {
        $this->converter = new ConversorMoedas();
    }

    public function convert($amount, $from, $to, $rate)
    {
        try {
// Validações básicas
            if (!is_numeric($amount) || !is_numeric($rate)) {
                throw new InvalidArgumentException('Valor e taxa devem ser números.');
            }

            $amount = floatval($amount);
            $rate = floatval($rate);
// Conversão
            $result = $this->converter->convert($amount, $from, $to, $rate);
// Resposta
            echo json_encode($result);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
