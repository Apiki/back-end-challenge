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

use PHPUnit\Framework\Constraint\IsFalse;

require __DIR__ . '\vendor\autoload.php';
include('src\functions.php');

$url = $_SERVER["REQUEST_URI"];
$parametros = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"], 'exchange') + 9);
$parametros = explode("/", $parametros);
//var_dump(is_numeric($parametros[0]));
if (empty($parametros[0])) {
    echo withoutValue();
} elseif (!is_numeric($parametros[0])) {
    echo invalidValue();
} elseif ($parametros[0] < 0) {
    echo negativeValue();
} elseif (empty($parametros[1])) {
    echo withoutFrom();
} elseif (empty($parametros[2])) {
    echo withoutTo();
} elseif (empty($parametros[3])) {
    echo withoutRate();
} elseif (is_numeric($parametros[3]) == false) {
    echo invalidRate();
} elseif ($parametros[3] < 0) {
    echo negativeRate();
} elseif ($parametros[1] != "BRL" && $parametros[1] != "USD" && $parametros[1] != "EUR") {
    echo invalidFrom();
} elseif ($parametros[2] != "BRL" && $parametros[2] != "USD" && $parametros[2] != "EUR") {
    echo invalidTo();
} else {
    if ($parametros[1] == "BRL" && $parametros[2] == "USD") {
        echo brlToUsd($parametros[0], $parametros[3]);
    }
    if ($parametros[1] == 'BRL' && $parametros[2] == 'EUR') {
        echo brlToEur($parametros[0], $parametros[3]);
    }
    if ($parametros[1] == 'EUR' && $parametros[2] == 'BRL') {
        echo eurToBrl($parametros[0], $parametros[3]);
    }
    if ($parametros[1] == 'USD' && $parametros[2] == 'BRL') {
        echo usdToBrl($parametros[0], $parametros[3]);
    }
}
