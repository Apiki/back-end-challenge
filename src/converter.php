<?php

class Converter {
    
  private $symbols = [
    'USD' => '$',
    'EUR' => '€',
    'BRL' => 'R$',
  ];

  public function dataValidation($amount, $currency_from, $currency_to, $rate){
    if(empty($amount) || !isset($amount) || empty($currency_from) || !isset($currency_from)
    || empty($currency_to) || !isset($currency_to) || empty($rate) || !isset($rate)){
      return false;
    }

    if(!is_numeric($amount) || $amount <= 0 || !is_numeric($rate) ||  $rate <= 0 ){
      return false;
    }

    if(preg_match('/^[^a-z]{3}$/', $currency_from) !== 1 || preg_match('/^[^a-z]{3}$/', $currency_to) !== 1){
      return false;
    }

    return true;
  }
    
  public function getSymbolCurrency($currency_to){
    return $this->symbols[$currency_to];
  }

  public function getConvert($amount, $rate){
    return round($amount * $rate, 2);
  }

}