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
 * @author   Rafael Carrasqueira Ferreira Santos <rafacarrasqueira@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
require_once 'src/Conversao.php';


header("Content-Type:application/json; charset:utf-8");
$data=[];



$url = explode('/', $_GET['url']);
$func = $url[0] ?? 'teste';
$amount = $url[1] ?? 0;
$from = strtoupper($url[2]) ?? 'USD';
$to = strtoupper($url[3]) ?? 'BRL';
$rate = $url[4] ?? 0.00;

$conversao = new Conversao;

if($func === "exchange" && $amount !== 0 
    && $from !== null && $to !== null && $rate!==0){
        
        $amount=json_decode($amount);
        $conversao->setAmount($amount);
        $conversao->setfrom_coin($from);
        $conversao->setto_coin($to);
        $rate = json_decode($rate);
        $conversao->setrate($rate);
        

        if(! $from==='BRL'){
            $resultado=$amount*$rate;
        }else{
            $resultado=$amount/$rate;
        }
        $conversao->setResultado(floatval($resultado));
        
        $data["conversao"] = $conversao->exchange();
        
}

if($func === "read" ){
        $data["conversao"] = $conversao->read();
}



print_r($data);