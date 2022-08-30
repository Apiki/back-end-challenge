<?php
function withoutRate()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function withoutTo()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function withoutFrom()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function withoutValue()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function invalidRate()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function invalidTo()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function invalidFrom()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function invalidValue()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function negativeValue()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
function negativeRate()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}

function brlToUsd($valor1, $valor2)
{
    if ($valor1 < 0 || $valor2 < 0) {
        return (header('400 Bad Request', true, 400));
    }
    $valorConvertido = $valor1 * $valor2;
    $simboloMoeda = "$";
    $resultado = array('valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda);
    return (json_encode($resultado));
}
function brlToEur($valor1, $valor2)
{
    if ($valor1 < 0 || $valor2 < 0) {
        return (header('400 Bad Request', true, 400));
    }
    $valorConvertido = $valor1 * $valor2;
    $simboloMoeda = "€";
    $resultado = array('valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda);
    return (json_encode($resultado, JSON_UNESCAPED_UNICODE));
}
function usdToBrl($valor1, $valor2)
{
    if ($valor1 < 0 || $valor2 < 0) {
        return (header('400 Bad Request', true, 400));
    }
    $valorConvertido = $valor1 * $valor2;
    $simboloMoeda = "R$";
    $resultado = array('valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda);
    return (json_encode($resultado));
}
function eurToBrl($valor1, $valor2)
{
    if ($valor1 < 0 || $valor2 < 0) {
        return (header('400 Bad Request', true, 400));
    }
    $valorConvertido = $valor1 * $valor2;
    $simboloMoeda = "R$";
    $resultado = array('valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda);
    return (json_encode($resultado));
}
