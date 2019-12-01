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
 * @author   Thiago Valente <thiagoavalente@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use App\Controllers\ConversionController;

$app = AppFactory::create();

$app->get('/exchange/{amount}/{from}/{to}/{rate}', ConversionController::class . ':convert');

try {
    $app->run();
} catch (Exception $e) {
    echo json_encode(new stdClass);
    http_response_code(400);
}
