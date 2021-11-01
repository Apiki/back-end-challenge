<?php

require('src/response.php');

class Exchange{

    private $amount;
    private $from;
    private $to;
    private $rate;

    function __construct($amount,$from, $to, $rate){
        $this->amount = (float)$amount ? (float)$amount : null;
        $this->from = (string)$from ? (string)$from : null ;
        $this->to = (string)$to ? (string)$to : null;
        $this->rate = (float)$rate ? (float)$rate : null;       
    }
    
  function convert(){        
        if(is_float($this->amount)
         && is_string($this->from) 
         && is_string($this->to) 
         && is_float($this->rate)){
            switch($this->from){
                case 'BRL':
                   if($this->to=="USD"){
                       $valConverted = $this->amount*$this->rate;
                       $result = array('valorConvertido'=> $valConverted, 'simboloMoeda'=> "$");
                       response(200,"Valor convertido", $result);
                       break;
                   }
                   if($this->to=="EUR"){
                        $valConverted = $this->amount*$this->rate;
                        $result = array('valorConvertido'=> $valConverted, 'simboloMoeda'=> '€');
                        response(200,"Valor convertido", $result);
                        break;
                    }
                case 'USD':
                    if($this->to=="BRL"){
                        $valConverted = $this->amount*$this->rate;
                        $result = array('valorConvertido'=> $valConverted, 'simboloMoeda'=> "R$");
                        response(200,"Valor convertido", $result);
                        break;
                    }
                  case 'EUR':
                    if($this->to=="BRL"){
                        $valConverted = $this->amount*$this->rate;
                        $result = array('valorConvertido'=> $valConverted, 'simboloMoeda'=> "R$");
                        response(200,"Valor convertido", $result);
                        break;
                    }
                default:
                response(400,"Invalid Request", NULL);
                break;

            }
           
           
        }else{
            response(400,"Invalid Request", NULL);
        }
    }
    function exec(){
        $this->convert();
    }


}



?>