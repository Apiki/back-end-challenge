<?php

class CurrencyConverter{
    public function converter($howmuch, $from, $to, $rate){
        
        if ($this->CheckIncome( $howmuch, $rate) && $this->CheckConversion($from, $to)){
         
            $valorConvertido = $howmuch * $rate;
         
            $CurrencySymbol = $this->getCurrency($to);
            
            
            return [
                "valorConvertido" => $valorConvertido,
                "simboloMoeda" => $CurrencySymbol
           ];
        }
        else{
            http_response_code(400);
            return "Confira os dados de entrada";
        }
    }

    public function CheckIncome($checkhowmuch, $checkrate){

        
 if (!is_numeric($checkhowmuch) || $checkhowmuch <= 0){
            return false;
        }
        else if(!is_numeric($checkrate)|| $checkrate <= 0){
            return false;
        }
        
        else{
            return true;
        }
        
    }
    
  public function CheckConversion($from, $to){

        if($this->getCurrency($from) && $this->getCurrency($to)){
            if ($from == "BRL" && $to == "USD") {return true;            } 
            else if ($from == "USD" && $to == "BRL") {return true;}
            else if ($from == "BRL" && $to == "EUR") {return true;}
            else if ($from == "EUR" && $to == "BRL") {return true;}
            else {return false;}
        }
        else {
            return false;
        }        
    }
    
 public function getCurrency($CurrencySymbol){
        switch ($CurrencySymbol) {
            case 'BRL': return 'R$';
            case 'USD': return '$';
            case 'EUR': return '€';
            default: return false;
        }
    }
}