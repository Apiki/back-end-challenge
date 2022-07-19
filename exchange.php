<?php
/* Deveria verificar a porta?
if ($_SERVER['SERVER_PORT'] != 8000) {
    $strErro = 'Porta não permitida!';
    ...
    return http_response_code(400);
}
*/

$params = explode( "/", $_GET['params'] );

// if (!ctype_upper($params)) { ... } Conferir se moedas em maiúsculo?

class Exchange {
    // Properties
    public $valorConvertido;
    public $simboloMoeda;
  
  }
$conversao = new Exchange();

if (count($params) != 4) {
    // $strErro = 'Quantidade de parâmetros inválida!';
    $resposta = json_encode($conversao);
    echo '';
    return http_response_code(400);
}

$amount = (float)$params[0];
$from = $params[1];
$to = $params[2];
$rate = (float)$params[3];

if (!(($from == 'BRL') && ($to == 'USD')) &&
     !(($from == 'USD') && ($to == 'BRL')) &&
     !(($from == 'BRL') && ($to == 'EUR')) &&
     !(($from == 'EUR') && ($to == 'BRL'))) {
        $strErro = 'Moeda(s) ou conversão(ões) inexistente(s)!';
        echo 'moeda';
        return http_response_code(400);
    }

if (!is_numeric($amount) || !is_numeric($rate) ||
    $amount <= 0 || $rate <= 0) {
        // $strErro = 'Valor(es) deve(m) ser numérico(s) e maior(es) que zero!';
        echo 'número';
        return http_response_code(400);
}

echo $strErro;

// Possiblidade de if ou array.
$simbolosMoedas = array(
    "BRL" => "R$",
    "USD" => "US$",
    "EUR" => "€", // Codificar caractere?
    );

$conversao->valorConvertido = $amount * $rate;
$conversao->simboloMoeda = $simbolosMoedas[$to];

$resposta = json_encode($conversao);
echo $resposta;
return http_response_code(200);
