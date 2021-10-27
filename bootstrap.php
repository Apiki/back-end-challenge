<?php

declare(strict_types=1);

/**
 * Rotas que fogem do padrão poderão ser declaradas aqui como rota personalizada.
*/
define('CONFIG', [
	'api_actions' => [
		'USD' => 'BRL',
		'EUR' => 'BRL',
		'BRL' => ['USD','EUR' ],
	]
]);