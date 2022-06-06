<?php
/**
 * API Para conversão de moedas
 * php version 7.4.3
 *
 * @category Conversão
 * @package  App\controllers
 * @author   Gustavo Breternitz <breternitzgustavo@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/CPLv3
 * @link     https://www.linkedin.com/in/gustavo-breternitz-9b83901ba/
 */
declare(strict_types=1);

require_once __DIR__ . '/src/rotas/Api.php';
require __DIR__ . '/vendor/autoload.php';

$rotas = new \App\rotas\Api();
