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
 * @author   Guilherme Barbosa <guilhermefelipebarbosa@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Config\Api;

$inputs = array();
$post = array();

$inputs['URI'] = $_SERVER['REQUEST_URI'];

$inputs['method'] = @$_SERVER['REQUEST_METHOD'];

$inputs['raw_input'] = @file_get_contents('php://input');

@parse_str($inputs['raw_input'] , $post);

$inputs = array_merge($inputs,$post);

$app = new Api($inputs);
$app->run();
