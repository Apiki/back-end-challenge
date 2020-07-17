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
 * @author   Seu Nome <juniorfalcao.jc@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

//HEADER
header("Access-Control-Allow-Origin: *");
header("Content-Type: application-json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = $_SERVER['REQUEST_URI'];
$data_uri = explode('/',$uri);

$controller = $data_uri[1];

$data = [
    'amount'=>$data_uri[2],
    'from'  =>$data_uri[3],
    'to'    =>$data_uri[4],
    'rate'  =>$data_uri[5]
];

if($controller == 'exchange'){
    $ex = new \App\Controllers\ExchangeController();
    $result = $ex->converter($data);
    echo json_encode($result);
}
