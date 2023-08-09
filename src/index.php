<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.2.8
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Júlio Freitas <jcsr.frts@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Router.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    Router::handleExchangeRequest($_SERVER['REQUEST_URI']);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}