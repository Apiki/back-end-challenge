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
 * @author   Rafaela Queiroz <rafaelaqueirozdev@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
namespace App\Classes;

class Coin {

    public function __construct() 
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        
        array_shift($uri);

        $uri = array_filter($uri);
        
        if (count($uri) != 0) {
            $this->verifyRequestParams($uri);
        }
    }

    public function exchange($amount, $from, $to, $rate) 
    {
        $price = $amount * $rate;
        $symbol = $this->getCurrencySymbol($to);

        $response = array(
            'valorConvertido' => $price,
            'simboloMoeda' => $symbol
        );

        echo json_encode($response);
    }

    public function verifyRequestParams($params)
    {
        $expected = ['amount', 'from', 'to', 'rate'];

        if ($params[0] === 'exchange') {
            
            array_shift($params);
            
            if (count($params) === count($expected) && ($params[1] != $params[2])) {
                
                $amount = is_numeric($params[0]) ? $params[0] : false;
                $from = $this->typeCoinExists($params[1]) ? $params[1] : false;
                $to = $this->typeCoinExists($params[2]) ? $params[2] : false;
                $rate = is_numeric($params[3]) ? $params[3] : false;
    
                if ($amount && $from && $to && $rate) {
                    $this->exchange($amount, $from, $to, $rate);
                }
            }
        }
            
        return http_response_code(404);
    }

    public function getCurrencySymbol($coin)
    {
        $symbols = [
            'BRL' => 'R$',
            'EUR' => '€',
            'USD' => '$'
        ];
        
        return $symbols[$coin];
    }
    
    public function typeCoinExists($coin)
    {
        $types = ['BRL', 'EUR', 'USD'];

        foreach ($types as $type) {
            if ($type === $coin) {
                return true;
            }
        }
        
        return false;
    }
}