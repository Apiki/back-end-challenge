<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   André Nascimento <andre.d.nascimento@uol.com.br>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare (strict_types = 1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . './classes/ConversorMoeda.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $parametros = explode('/', $_SERVER['REQUEST_URI']);
    
    if (count($parametros) >= 6) {
            $valorDe = $parametros[2];
            $converterDe = $parametros[3];
            $converterPara = $parametros[4];
            $valorPara = $parametros[5];

            $conversor = new ConversorMoeda();
            $result = $conversor->converter($valorDe, $converterDe, $converterPara, $valorPara);
            echo $result;
    } else {
            // Retorna uma resposta de erro se os parâmetros estiverem faltando
            $conversor = new ConversorMoeda();
            $result = $conversor->getResponseJson(400, 'Um ou mais parâmetros estão faltando');
            echo $result;
    }
}
