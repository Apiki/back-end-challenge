<?php
class ConversorMoeda
{
    private $moedas = array(
            'USD' => '$',
            'BRL' => 'R$',
            'EUR' => '€',
    );

    public function converter($valorDe, $converterDe, $converterPara, $valorPara)
    {
        if (empty($valorDe) || empty($converterPara) || empty($valorPara) || empty($converterDe)) {
                return $this->getResponseJson(400, 'Um ou mais parâmetros estão faltando');
        }

        if ($valorPara <= 0 || $valorDe <= 0) {
                return $this->getResponseJson(400, 'Valor não pode ser negativo');
        }

        if (!is_numeric($valorDe) || !is_numeric($valorPara)) {
                return $this->getResponseJson(400, 'Valores devem ser números válidos');
        }

            $moedaDe = $this->getMoeda($converterDe);
        if ($moedaDe === null) {
                return $this->getResponseJson(400, 'Moeda de origem inválida');
        }

            $moedaPara = $this->getMoeda($converterPara);
        if ($moedaPara === null) {
                return $this->getResponseJson(400, 'Moeda de destino inválida');
        }

            $valorConvertido = $valorDe * $valorPara;

            $data = array(
                    'valorConvertido' => $valorConvertido,
                    'simboloMoeda' => $moedaPara
            );

            return $this->getResponseJson(200, $data);
    }

    public function getResponseJson($statusCode, $data)
    {
            http_response_code($statusCode);
            return json_encode($data);
    }

    private function getMoeda($codMoeda)
    {
            return $this->moedas[$codMoeda] ?? null;
    }
}
