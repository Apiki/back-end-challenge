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
 * @author   Murillo Torres <murillotttorres@live.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

header('Content-Type: application/json');

// Configuração do servidor embutido para tratar a estrutura da URL
if (php_sapi_name() === 'cli-server') {
    if (is_file(__DIR__ . $_SERVER['REQUEST_URI'])) {
        return false;
    }
}

require 'vendor/autoload.php';

// Obtenção dos parâmetros da URL usando variáveis superglobais
$uri = $_SERVER['REQUEST_URI'];
$baseUrl = '/exchange/';
if (strpos($uri, $baseUrl) === 0) {
    $paramsString = substr($uri, strlen($baseUrl));
    $params = explode('/', $paramsString);

    // Verifica se os parâmetros foram fornecidos
    if (isset($params[0])) {
        $amount = floatval($params[0]);
    } else {
        // Retorna erro se a quantidade de parâmetros estiver incorreta
        http_response_code(400);
        echo json_encode(["error" => "Dados incompletos"]);
        exit;
    }
    if (isset($params[1])) {
        $from = strtoupper($params[1]);
    } else {
        // Retorna erro se a quantidade de parâmetros estiver incorreta
        http_response_code(400);
        echo json_encode(["error" => "Dados incompletos"]);
        exit;
    }
    if (isset($params[2])) {
        $to = strtoupper($params[2]);
    } else {
        // Retorna erro se a quantidade de parâmetros estiver incorreta
        http_response_code(400);
        echo json_encode(["error" => "Dados incompletos"]);
        exit;
    }
    if (isset($params[3])) {
        $rate = floatval($params[3]);
    } else {
        // Retorna erro se a quantidade de parâmetros estiver incorreta
        http_response_code(400);
        echo json_encode(["error" => "Dados incompletos"]);
        exit;
    }

    // Verificação para garantir que os valores numéricos nos parâmetros são válidos
    if (!is_numeric($amount) || !is_numeric($rate)) {
        http_response_code(400);
        echo json_encode(["error" => "Valores inválidos nos parâmetros"]);
        exit;
    }

    // Verificação adicional para garantir que o valor numérico é maior que zero
    if ($amount <= 0 || $rate <= 0) {
        http_response_code(400);
        echo json_encode(["error" => "Valores inválidos nos parâmetros"]);
        exit;
    }

    // Verificação para permitir apenas conversões permitidas
    $convers = [
        'BRL' => ['USD', 'EUR'],
        'USD' => ['BRL'],
        'EUR' => ['BRL'],
    ];
    if (!array_key_exists($from, $convers) || !in_array($to, $convers[$from])) {
        http_response_code(400);
        echo json_encode(["error" => "Conversão não permitida"]);
        exit;
    }

    // Função para converter a moeda
    /**
     * Converte uma quantia de uma moeda para outra com base na taxa de câmbio.
     *
     * @param float  $amount Valor a ser convertido.
     * @param string $from   Moeda de origem.
     * @param string $to     Moeda de destino.
     * @param float  $rate   Taxa de conversão.
     *
     * @return float Valor convertido.
     */
    function converterMoeda($amount, $from, $to, $rate)
    {
        $convertedAmount = $amount * $rate;
        return round($convertedAmount, 2);
    }

    /**
     * Obtém o símbolo da moeda.
     *
     * @param string $to Moeda de destino.
     *
     * @return string Símbolo da moeda.
     */
    function getSymbol($to)
    {
        if ($to == 'EUR') {
            return "€";
        } else if ($to == 'USD') {
            return "$";
        } else {
            return "R$";
        }
    }

    $convertedAmount = converterMoeda($amount, $from, $to, $rate);
    $symbol = getSymbol($to);

    // Monta a resposta em formato JSON
    $responsePayload = [
        "valorConvertido" => $convertedAmount,
        "simboloMoeda" => $symbol,
    ];

    echo json_encode($responsePayload);

} else {
    // Retorna erro se a URL não estiver no formato esperado
    http_response_code(400);
    echo json_encode(["error" => "URL inválida"]);
    exit;
}
