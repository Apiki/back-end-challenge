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
	declare(strict_types = 1);


	require_once 'API/APIKI/ConvertCoin.php';

	$open = new REST_API_APIKI();
	echo($open->abrir($_REQUEST));