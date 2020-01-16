<?php

class Converter {
    
  private $symbols = [
    'USD' => '$',
    'EUR' => '€',
    'BRL' => 'R$',
  ];

  public function dataValidation($amount, $currency_from, $currency_to, $rate){
    if(!is_numeric($amount) || $amount <= 0 || !is_numeric($rate) ||  $rate <= 0 ){
      return false;
    }

    if(preg_match('/^[^a-z]{3}$/', $currency_from) !== 1 || preg_match('/^[^a-z]{3}$/', $currency_to) !== 1){
      return false;
    }

    return true;
  }

  public function getResult($amount, $rate, $currency_to){
    $value = round($amount * $rate, 2);
    $symbol = $this->symbols[$currency_to];
    $response = array();
    $response['status_code_header'] = 'HTTP/1.1 200 OK';
    $result = array('valorConvertido' => $value, 'simboloMoeda' => $symbol);
    $response['body'] = json_encode($result);
    return $response;
  }

}