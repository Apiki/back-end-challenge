<?php
class Conversor{
    public function converter($valor, $de, $para, $cotacao){
        if ($this->validarEntrada($valor, $cotacao) && $this->validarConversão($de, $para)){
            $valorConvertido = $valor * $cotacao;
            $moeda = $this->obterMoeda($para);
            
            $Resultado = array("valorConvertido" => $valorConvertido, "simboloMoeda"=> $moeda);
            return $Resultado;
        }
        else{
            http_response_code(400);
            return "Conversão inválida";
        }
    }

    private function validarEntrada($val, $cot){
        if (!is_numeric($val) || $val <= 0){
            return false;
        }
        else if(!is_numeric($cot)|| $cot <= 0){
            return false;
        }
        else{
            return true;
        }
        
    }
    
    private function validarConversão($de, $para){
        if($this->obterMoeda($de) && $this->obterMoeda($para)){
            if ($de == "BRL" && $para == "USD") {return true;            } 
            else if ($de == "USD" && $para == "BRL") {return true;}
            else if ($de == "BRL" && $para == "EUR") {return true;}
            else if ($de == "EUR" && $para == "BRL") {return true;}
            else {return false;}
        }
        else {
            return false;
        }        
    }
    
    private function obterMoeda($moeda){
        switch ($moeda) {
            case 'BRL': return 'R$';
            case 'USD': return '$';
            case 'EUR': return '€';
            default: return false;
        }
    }
}