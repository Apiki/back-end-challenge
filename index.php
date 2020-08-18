<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
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

require __DIR__ . '/vendor/autoload.php';

use Controller\MoedaController;

$urlParams = explode("/", $_SERVER['REQUEST_URI']);

$valorOrigem = $urlParams[2];
$moedaOrigem = $urlParams[3];
$moedaDestino = $urlParams[4];
$indiceConversao = $urlParams[5];

$conversor = new MoedaController();
$result = $conversor->converteMoeda($valorOrigem, $moedaOrigem, $moedaDestino, $indiceConversao);

echo json_encode($result);
