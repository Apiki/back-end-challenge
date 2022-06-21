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
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';


#http://localhost:8000/exchange/{amount}/{from}/{to}/{rate}
#http://localhost:8000/exchange/10/BRL/USD/4.50

/* torna a uri em um array */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);


function decimal_moeda($valor) 
{
    $decimal = str_replace(',', '.', $valor);
    return $decimal;
}

/* símbolos */
$simbolo_real   = 'BRL';
$simbolo_dolar  = 'USD';
$simbolo_euro   = 'EUR';

/* real para dólar */
if(isset($uri[3]) == $simbolo_real and isset($uri[4]) == $simbolo_dolar) :
    $valor_convertido = decimal_moeda($uri[2]) / decimal_moeda($uri[5]);
    $simbolo_moeda = 'U$';

/* dólar para real */
elseif(isset($uri[3]) == $simbolo_dolar and isset($uri[4]) == $simbolo_real) :
    $valor_convertido = decimal_moeda($uri[2]) * decimal_moeda($uri[5]);
    $simbolo_moeda = 'R$';

/* De Real para Euro */
elseif(isset($uri[3]) == $simbolo_real and isset($uri[4]) == $simbolo_euro) :
    $valor_convertido = decimal_moeda($uri[2]) / decimal_moeda($uri[5]);
    $simbolo_moeda = '€';

/*  Euro para Real */
elseif(isset($uri[3]) == $simbolo_euro and isset($uri[4]) == $simbolo_real) :
    $valor_convertido = decimal_moeda($uri[2]) * decimal_moeda($uri[5]);
    $simbolo_moeda = 'R$';

else :
    echo "<strong>Conversão de moeda inválida, Digite corretamente!</strong>
        <p>Exemplo: http://localhost:8000/exchange/10/BRL/USD/4.50</p>";
    exit();
    
endif;

$arr = array(
    "valorConvertido" => number_format($valor_convertido, 2, '.'),
    "simboloMoeda" => $simbolo_moeda
);

echo json_encode($arr, JSON_NUMERIC_CHECK);