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
 * @author   Adler Oliveira <adler.deoliveira@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
 	
	header('Content-Type: application/json; charset=utf-8');

	require_once 'API/APIKI/Apiki.php';

	if (isset($_REQUEST)) {		echo REST_API_APIKI::abrir($_REQUEST);		}


?>