<?php
include('Request.php');
class Currency {

  protected $symbol;
  protected $name;
  protected $request;
  protected $base_url = "https://api.exchangeratesapi.io";
  protected $currency_available = [
    'eur',
    'usd',
    'brl'
  ];
  protected $symbols = [
    'EUR'=>'€',
    'USD'=>'$',
    'BRL'=>'R$'
  ];
  public function __construct(){

    $this->request = new Request($this->base_url);
  }

  public function convert($params){
    //verificano se os dados passados sao validos
    if(!in_array($params['from'],$this->currency_available)){
      return ['error'=>['message'=>'currency not available']];
    }

    if(!in_array($params['to'],$this->currency_available)){
      return ['error'=>['message'=>'currency not available']];
    }
    
    $from = strtoupper($params['from']);
    $to = strtoupper($params['to']);
    $amount = floatval($params['amount']);
    $response = $this->request->make("/latest?base=$from");
    if(!$response){
      return ['error'=>'error on convert currency'];
    }
    $amount_converted = $amount * $response['rates'][$to];

    $amount_converted =  number_format($amount_converted,2,',','.');

    $response = ['from'=>$from,'to'=>$to,'currency'=>$this->symbols[$to]." ".$amount_converted];
    return $response;
  }

}