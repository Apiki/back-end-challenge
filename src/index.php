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
 * @author   Lucas Felype Fonseca Santos <lucasfelypeqw@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

use App\Controller\ConverterController;
$controller = new ConverterController();
header('Content-Type: application/json');

$data = parseRequestData($_SERVER['REQUEST_URI']);
if (isset($data['error'])) {
    echo json_encode($data);
    exit;
}

$response = $controller ->handle($data);

/**
 * Parse request data from URI.
 *
 * @param string $uri Request URI.
 *
 * @return array
 */function parseRequestData($uri): array
{
    $format = explode("/", trim($uri, '/'));

    if (count($format) !== 5 || $format[0] !== 'exchange') {
        http_response_code(400);
        echo json_encode(
            ["error" => 'Rota invalida']
        );
        exit;
    }
    return [
        'exchange' => $format[0],
        'amount'   => $format[1],
        'from'     => $format[2],
        'to'       => $format[3],
        'rate'     => $format[4]
    ];
};

echo json_encode($response);

