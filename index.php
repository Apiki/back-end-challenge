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
 * @author   Henrique Venchiarutti <henriquevenchiarutti@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/henriquevenchiarutti/back-end-challenge
 */
declare(strict_types=1);

use Challenge\Source\Model\Request;

require_once __DIR__ . '/src/Model/Request.php';

require __DIR__ . '/vendor/autoload.php';

$request = new Request();
$result = $request->handleRequest();

if ($result) {
    header('Content-Type: application/json');
    header('HTTP/1.1 200');
    $response['body'] = json_encode($result,  JSON_UNESCAPED_UNICODE);
    echo $response['body'];
} else {
    header('Content-Type: application/json');
    header('HTTP/1.1 400');
    $response['body'] = json_encode([
        'error' => "Invalid Parameters"
    ], JSON_UNESCAPED_UNICODE);
    echo $response['body'];
}

