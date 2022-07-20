<?php
/* Deveria verificar a porta?
if ($_SERVER["SERVER_PORT"] != 8000) {
    $strErro = "Porta não permitida!";
    echo "";
    return http_response_code(400);
}
*/

$params = explode( "/", $_GET['params'] );

class Exchange {
    // Properties
    public $valorConvertido;
    public $simboloMoeda;
  
  }
$conversao = new Exchange();

if (count($params) != 5) {
    // $strErro = "Quantidade de parâmetros inválida!";
    echo "";
    return http_response_code(400);
}

// Pasta é "exchange"?
if ($params[0] != "exchange") {
    // $strErro = "URL inválida!";
    echo "";
    return http_response_code(400);
}

$amount = (float)$params[1];
$from = $params[2];
$to = $params[3];
$rate = (float)$params[4];

// if (!ctype_upper($from)) { ... } Conferir se moeda está com caracteres em maiúsculo?
// if (!ctype_upper($to)) { ... } Conferir se moeda está com caracteres em maiúsculo?


if (!(($from == "BRL") && ($to == "USD")) &&
     !(($from == "BRL") && ($to == "EUR")) &&
     !(($from == "EUR") && ($to == "BRL"))) {
        $strErro = "Moeda(s) ou conversão(ões) inexistente(s)!";
        echo "";
        return http_response_code(400);
    }

if (!is_numeric($amount) || !is_numeric($rate) ||
    $amount <= 0 || $rate <= 0) {
        // $strErro = "Valor(es) deve(m) ser numérico(s) e maior(es) que zero!";
        echo "";
        return http_response_code(400);
}

echo $strErro;

// Possiblidade de if ou array.
$simbolosMoedas = array(
    "BRL" => "R$",
    "USD" => "$",
    "EUR" => "€", // Codificar caractere?
    );

$conversao->valorConvertido = $amount * $rate;
$conversao->simboloMoeda = $simbolosMoedas[$to];

$resposta = json_encode($conversao);
echo $resposta;
return http_response_code(200);
