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
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

require("./bootstrap.php");
require __DIR__ . '/vendor/autoload.php';

use App\core\Controller;

try{
	$controller = new Controller;
	$controller->load();
	$controller->exec();
}catch(\Exception $e){
	echo $e->getMessage();
	die;
}


