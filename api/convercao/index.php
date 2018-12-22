<?php
require dirname(__FILE__) . '/dinheiro.php';

header("Access-Controll-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$d = new Dinheiro();

$parametros->dolar = $_GET['dolar'];
$parametros->real = $_GET['real'];
$parametros->euro = $_GET['euro'];
$parametros->destino = $_GET['destino'];

$resposta = $d->converter($parametros);

echo json_encode($resposta);

?>