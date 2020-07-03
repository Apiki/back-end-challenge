<?php declare (strict_types = 1);

class Coin
{
    public $coins = array(
        'BRL' => array ('USD', 'EUR'),
        'USD' => array ('BRL'),
        'EUR' => array ('BRL'),
    );

    public $simbolosCoin = array('BRL' => 'R$', 'USD' => '$', 'EUR' => '€');

    public function convert($amount, $from, $to, $rate)
    {
        if(!($this->validadeNumber($amount) && $this->validadeNumber($rate))){
            http_response_code(400);
            echo json_encode('');
            return;
        }
        
        if (!($this->validadeCoins($from, $to))){
            http_response_code(400);
            echo json_encode('');
            return;
        }

        $valorConvertido = $this->converteValue($amount, $rate);
        $simboloMoeda = $this->simbolosCoin[$to];

        $result = array("valorConvertido" => $valorConvertido,
                        "simboloMoeda" => $simboloMoeda);
        
        echo json_encode($result);
    }

    private function validadeNumber($value){
        return !preg_match('/[^0-9.]+/', $value);
    }

    private function validadeCoins($from, $to){
        return isset($this->coins[$from]) &&  in_array($to, $this->coins[$from]);
    }

    public function converteValue($amount, $rate){
        return $amount * $rate;
    }
}
