<?php

/**
 * Class WebApiUtil
 * Função: Classe responsável validar os parâmetros de entradas.
 */
class UrlUtil
{
    private $moedasApi = ['BRL', 'USD', 'EUR'];

    public function getParametros($url)
    {
        $url = ltrim($url, '/');
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        $urlObject = new stdClass();
        try {
            if (sizeof($url) == 0 || sizeof($url) < 5 || sizeof($url) > 5) {
                throw new Exception('Requisição incorreta... Parametros de entrada: ' . sizeof($url));
            }
            $urlObject->moedaDe = mb_strtoupper($url[0]);
            $urlObject->valor = $url[1];
            $urlObject->valorCotacao = $url[2];
            $urlObject->moedaPara = mb_strtoupper($url[3]);
            $urlObject->tipo = $url[4];
            $this->validateRequest($urlObject->moedaDe, $urlObject->moedaPara, $urlObject->valorCotacao, $urlObject->valor, $urlObject->tipo);
            return $urlObject;
        } catch (Exception $exception) {
            throw $exception;
        }

    }

    private function validateRequest($moedaDe, $moedaPara, $vlrCotacao, $valor, $tipo)
    {
        $conversaoAceita = ['0-1', '1-0', '0-2', '2-0'];
        $key = array_search($moedaDe, $this->moedasApi) . '-' . array_search($moedaPara, $this->moedasApi);
        if ($moedaDe == $moedaPara) {
            throw new Exception('Não é permitido converter a mesma moeda...');
        }
        if (strlen($moedaDe) <> 3 || strlen($moedaPara) <> 3) {
            throw new Exception(' A sigla deve ter 3 letras...');
        }
        if (!in_array($moedaDe, $this->moedasApi)) {
            throw new Exception('Moeda não disponível para conversão...');
        }
        if (!in_array($moedaPara, $this->moedasApi)) {
            throw new Exception('Moeda não disponível para conversão...');
        }
        if (!is_numeric($vlrCotacao)) {
            throw new Exception('O valor da cotação não é  do tipo númerico.');
        }
        if (!is_numeric($valor)) {
            throw new Exception('O valor da cotação não é  do tipo númerico.');
        }
        if (!in_array($key, $conversaoAceita)) {
            throw  new Exception('Só é permite conversão do TIPO: BRL - USD, USD - BRL, BRL - EUR,EUR - BRL');
        }
        if (!in_array($tipo, ['json', 'csv', 'txt'])) {
            throw new Exception('Tipo de retorno inválido.');
        }

    }
}