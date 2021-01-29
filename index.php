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
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

//Tipos de Moeda
define("MOEDA", ['BRL', 'USD', 'EUR',]);
//Cotações atuais estáticas para validar na URL;
define("COTACAO_DOLAR", 5.45);
define("COTACAO_EURO", 6.59);

class Conversor {

    public static function iniciar($REQUEST_URI){

        // Pega a URL transforma em array separado pela "/"(barra)
        // Depois utilizo o array_filter para eliminar posições do array com elemntos vazios.
        $url = explode('/', $REQUEST_URI);
        $url = array_filter($url);

        // Validação do tamanho padrão de parametros da URL que deve ser 5.
        if(sizeof($url) !== 5){
            return 'A URL não está sendo informada corretamente!';
        }else{
            // Valida todos os parametros passados na URL.
            $erros = Conversor::validacaoParams($url);
            if(is_null($erros)){
                //Faz a conversão da moeda de acordo com as regras e retorna um JSON.
                return json_encode(Conversor::converter($url), JSON_UNESCAPED_UNICODE);
            }else{
                return $erros;
            }
        }

    }

    public static function converter($array){

        $resultado = array();

        //De Real para Dólar;
        if($array[3] === 'BRL' && $array[4] === 'USD'){
            $resultado['valorConvertido'] = (double)filter_var(number_format($array[2] * $array[5] , 2), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $resultado['simboloMoeda'] = '$';
        }

        //De Dólar para Real;
        if($array[3] === 'USD' && $array[4] === 'BRL'){
            $resultado['valorConvertido'] = (double)filter_var(number_format($array[2] / $array[5] , 2), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $resultado['simboloMoeda'] = 'R$';
        }

        //De Real para Euro;
        if($array[3] === 'BRL' && $array[4] === 'EUR'){
            $resultado['valorConvertido'] = (double)filter_var(number_format($array[2] * $array[5] , 2), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $resultado['simboloMoeda'] = '€';
        }

        //De Euro para Real;
        if($array[3] === 'EUR' && $array[4] === 'BRL'){
            $resultado['valorConvertido'] = (double)filter_var(number_format($array[2] / $array[5] , 2), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $resultado['simboloMoeda'] = 'R$';
        }

        return $resultado;

    }

    public static function validacaoParams($array){

        if($array[1] !== 'exchange')
            return 'O parametro {exchange} não foi informado na posição correta!';

        if(!is_numeric($array[2]))
            return 'O parametro {amount} deve ser informado e possuir valor numérico!';

        if((!in_array($array[3], MOEDA)) || empty($array[3]))
            return 'O código da moeda {from} deve ser informada corretamente!';

        if((!in_array($array[4], MOEDA)) || empty($array[3]))
            return 'O código da moeda {to} deve ser informada corretamente!';
        
        if($array[3] === $array[4])
            return 'O código da moeda do {from} e {to} não podem ser iguais!';

        if(($array[3] === 'USD' || $array[4] === 'EUR') || ($array[3] === 'EUR' || $array[4] === 'USD')){
            if(($array[4] !== 'BRL' && $array[3] !== 'BRL'))
                return 'Essa URL não converte EUR em USD ou vice e versa! Por favor, ajuste a URL!';
        }
            
        if(!is_numeric($array[5])){
            return 'O parametro {rate} deve ser informado e possuir valor numérico!';
        }else{
            if(($array[4] === 'USD' || $array[3] === 'USD') && floatval($array[5]) !== COTACAO_DOLAR)
                return 'O valor da cotação do dollar {rate} atualmente é '. COTACAO_DOLAR . ', por favor altere na URL!';
            if(($array[4] === 'EUR' || $array[3] === 'EUR') && floatval($array[5]) !== COTACAO_EURO)
                return 'O valor da cotação do dollar {rate} atualmente é '. COTACAO_EURO . ', por favor altere na URL!';
        }

        return null;

    }

}

if(isset($_REQUEST))
    echo Conversor::iniciar($_SERVER['REQUEST_URI']);
