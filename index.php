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
 * @author   Marcos Matos <marcosvm000@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/MarcosVVMK/marcos-matos
 */
declare(strict_types=1);

use App\Controllers\RequestController;

require __DIR__ . '/vendor/autoload.php';

$controller = new RequestController();

$controller->processRequest(explode('/', $_SERVER['REQUEST_URI']));

