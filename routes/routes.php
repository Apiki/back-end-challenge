<?php

// EXEMPLO DE URL:
/*
{
	[url]/[moeda-to-moeda]/[value]/[price]

    -> url: domínio que está sendo utilizado, no nosso caso estamos usando o "localhost" mesmo.
    -> moeda-to-moeda: de qual moeda para qual moeda o valor vai ser convertido.
    -> value: valor a ser convertido.
    -> price: cotação do dólar ou do euro.
}
*/

/* CONVERSÃO DE REAL PARA DÓLAR */
$app->get('/real-to-dolar/{value}/{price}', function ($request, $response, $args)
{
    $value = $args["value"];
    $price = str_replace(",", ".", $args["price"]);

    $conversion = $value / $price;

    $result = [
        "coin" => "$",
        "value" => $conversion
    ];

    return $response -> withJson($result);
});
/* FIM - CONVERSÃO DE REAL PARA DÓLAR */

/* CONVERSÃO DE DÓLAR PARA REAL */
$app->get('/dolar-to-real/{value}/{price}', function ($request, $response, $args)
{
    $value = $args["value"];
    $price = str_replace(",", ".", $args["price"]);

    $conversion = $value * $price;

    $result = [
        "coin" => "R$",
        "value" => $conversion
    ];

    return $response -> withJson($result);
});
/* FIM - CONVERSÃO DE DÓLAR PARA REAL */

/* CONVERSÃO DE REAL PARA EURO */
$app->get('/real-to-euro/{value}/{price}', function ($request, $response, $args)
{
    $value = $args["value"];
    $price = str_replace(",", ".", $args["price"]);

    $conversion = $value / $price;

    $result = [
        "coin" => "€",
        "value" => $conversion
    ];

    return $response -> withJson($result);
});
/* FIM - CONVERSÃO DE REAL PARA EURO */

/* CONVERSÃO DE EURO PARA REAL */
$app->get('/euro-to-real/{value}/{price}', function ($request, $response, $args)
{
    $value = $args["value"];
    $price = str_replace(",", ".", $args["price"]);

    $conversion = $value * $price;

    $result = [
        "coin" => "R$",
        "value" => $conversion
    ];

    return $response -> withJson($result);
});
/* FIM - CONVERSÃO DE EURO PARA REAL */

/* ERRO 500 */
$app->get('/500-error', function ($request, $response, $args)
{
    $data = [
        "erro" => "500"
    ];

    return $response -> withJson($data);
});
/* ERRO 500 */

?>