<?php
/**
 * Função para retornar o erro de valor de conversão vazio.
 *
 * @return json retorna o valor de erro 400.
 */
function withoutRate()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de moeda de destino vazia.
 *
 * @return json retorna o valor de erro 400.
 */
function withoutTo()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de moeda de origem vazia.
 *
 * @return json retorna o valor de erro 400.
 */
function withoutFrom()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de valor vazio.
 *
 * @return json retorna o valor de erro 400.
 */
function withoutValue()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de valor de conversão inválido.
 *
 * @return json retorna o valor de erro 400.
 */
function invalidRate()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de moeda de destino inválida.
 *
 * @return json retorna o valor de erro 400.
 */
function invalidTo()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de moeda de origem inválida.
 *
 * @return json retorna o valor de erro 400.
 */
function invalidFrom()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de valor inválido.
 *
 * @return json retorna o valor de erro 400.
 */
function invalidValue()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de valor negativo.
 *
 * @return json retorna o valor de erro 400.
 */
function negativeValue()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para retornar o erro de valor de conversão negativo.
 *
 * @return json retorna o valor de erro 400.
 */
function negativeRate()
{
    http_response_code(400);
    $resultado = array('error' => '400');
    return (json_encode($resultado));
}
/**
 * Função para fazer o calculo de Real para Dólar.
 * 
 * @param string $valor1 é o valor passado via GET para conversão.
 * @param string $valor2 é a taxa de conversão passada via GET para conversão.
 * 
 * @return json  retorna o valor resultado da conversão de Real para Dólar.
 */
function brlToUsd($valor1, $valor2)
{
    $valorConv = $valor1 * $valor2;
    $simboloM = "$";
    $resultado = array('valorConvertido' => $valorConv, 'simboloMoeda' => $simboloM);
    return (json_encode($resultado));
}
/**
 * Função para fazer o calculo de Real para Euro.
 * 
 * @param string $valor1 é o valor passado via GET para conversão.
 * @param string $valor2 é a taxa de conversão passada via GET para conversão.
 * 
 * @return json retorna o valor resultado da conversão de Real para Euro
 */
function brlToEur($valor1, $valor2)
{
    $valorConv = $valor1 * $valor2;
    $simboloM = "€";
    $resultado = array('valorConvertido' => $valorConv, 'simboloMoeda' => $simboloM);
    return (json_encode($resultado, JSON_UNESCAPED_UNICODE));
}
/**
 * Função para fazer o calculo de Dólar para Real.
 * 
 * @param string $valor1 é o valor passado via GET para conversão.
 * @param string $valor2 é a taxa de conversão passada via GET para conversão.
 * 
 * @return json retorna o valor resultado da conversão de Dólar para Real
 */
function usdToBrl($valor1, $valor2)
{
    $valorConv = $valor1 * $valor2;
    $simboloM = "R$";
    $resultado = array('valorConvertido' => $valorConv, 'simboloMoeda' => $simboloM);
    return (json_encode($resultado));
}
/**
 * Função para fazer o calculo de Euro para Real.
 * 
 * @param string $valor1 é o valor passado via GET para conversão.
 * @param string $valor2 é a taxa de conversão passada via GET para conversão.
 * 
 * @return json retorna o valor resultado da conversão de Euro para Real
 */
function eurToBrl($valor1, $valor2)
{
    $valorConv = $valor1 * $valor2;
    $simboloM = "R$";
    $resultado = array('valorConvertido' => $valorConv, 'simboloMoeda' => $simboloM);
    return (json_encode($resultado));
}
?>