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
 * @author   Seu Nome <fernandotakagi23@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require_once(__DIR__.'/vendor/autoload.php');

// Ponto único de entrada, controlando Rotas e Controladores
$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__.'/src/Config/Rotas.php'; 

//Inicia a Sessão
session_start();

//Verifica se a Rota existe
if(!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit;
}

//Instancia o método Processa 
$classeControladora = $rotas[$caminho]; 
$controlador = new $classeControladora();
$controlador->Processa();