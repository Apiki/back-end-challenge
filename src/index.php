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
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Conversor;

header('Content-Type: application/json; charset=utf-8');

$caminho = $_SERVER['REQUEST_URI'];
$partes = explode('/', trim($caminho, '/'));

if (isset($partes[0]) && $partes[0] === 'exchange') {
    array_shift($partes);
}

if (count($partes) < 4) {
    http_response_code(400);
    echo json_encode(['erro' => 'Parâmetros insuficientes.']);
    exit;
}

[$valorBruto, $de, $para, $taxaBruta] = $partes;

$valorBruto = str_replace('_', '.', $valorBruto);
$taxaBruta  = str_replace('_', '.', $taxaBruta);

if (!is_numeric($valorBruto) || (float) $valorBruto < 0) {
    http_response_code(400);
    echo json_encode(['erro' => 'Valor deve ser numérico e positivo.']);
    exit;
}

if (!is_numeric($taxaBruta) || (float) $taxaBruta < 0) {
    http_response_code(400);
    echo json_encode(['erro' => 'Taxa deve ser numérica e positiva.']);
    exit;
}

if ($de !== strtoupper($de) || $para !== strtoupper($para)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Moedas devem estar em maiúsculas.']);
    exit;
}

$valor = (float) $valorBruto;
$taxa  = (float) $taxaBruta;

$conversor = new Conversor();

if (!$conversor->moedaValida($de) || !$conversor->moedaValida($para)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Moeda não suportada.']);
    exit;
}

if (!$conversor->conversaoSuportada($de, $para)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Conversão não suportada.']);
    exit;
}

http_response_code(200);
echo json_encode($conversor->converter($valor, $de, $para, $taxa));

