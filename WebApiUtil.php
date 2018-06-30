<?php

/**
 * Class WebApiUtil
 * Função: Classe responsável por realizar a conversão das moedas.
 */
class WebApiUtil
{
    private $moedasApi = ['BRL', 'USD', 'EUR'];
    private $moedasSimbolo = ['R$', '$', '€'];

    public function processConversao($moedaDe, $moedaPara, $vlrCotacao, $valor, $tipoRetorno = 'json')
    {
        try {
            $chave = array_search($moedaPara, $this->moedasApi);
            $moedaConvertida = new stdClass();
            $moedaConvertida->simbolo = $this->moedasSimbolo[$chave];
            $moedaConvertida->sigla = $this->moedasApi[$chave];
            $moedaConvertida->success = true;
            switch ($moedaDe) {
                case 'BRL':
                    $moedaConvertida->valor = round($valor / $vlrCotacao, 2);
                    break;
                default:
                    $moedaConvertida->valor = round($valor * $vlrCotacao, 2);
            }
            switch ($tipoRetorno) {
                case 'json':
                    header('Content-Type: application/json');
                    echo json_encode($moedaConvertida);
                    break;
                case 'csv':
                    header('Content-Type: application/csv');
                    echo $moedaConvertida->simbolo . ';' . $moedaConvertida->sigla . ';' . $moedaConvertida->valor;
                    break;
                case 'txt':
                    echo $moedaConvertida->simbolo . $moedaConvertida->valor;
                    break;
            }
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}