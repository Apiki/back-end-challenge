<?php

/**
 * Back-end Challenge.
 *
 * PHP version 8.0.0
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Diego de Sousa Dias <diasdsdiego@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/Dias-D/Apiki-Challenge
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Routes\Router;

$router = new Router();
$router->router();
