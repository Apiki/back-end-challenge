<?php

class Conversor{

    public $valor;
    public $cotacao;
    public $moeda_de;
    public $moeda_para;

    function converter(){

       $this->validacao();
       switch ($this->moeda_de){
           case 'real':
               ($this->moeda_para == 'dolar' ? $this->calculo('/', '$') : '' );
               ($this->moeda_para == 'euro'  ? $this->calculo('/', '€') : '' );
               break;

           case 'dolar':
           case 'euro':
               ($this->moeda_para=='real' ? $this->calculo('*','R$') : '' );
               break;
       }
    }

   private function calculo($operador, $simbolo){

        if($operador == '*'){
            $total = $this->valor * $this->cotacao;
        }else{
            $total = $this->valor / $this->cotacao;
        }
        echo $simbolo .number_format((float)$total, 2, ',', '.');
   }

   private function validacao(){

       $moedas_aceitas= array(
           'real',
           'dolar',
           'euro'
       );

       $msgHeader = "Os seguntes parâmetros estão vazios ou são inválidos:".'<br>';
       $msg=null;

       if(!$this->valor){
           $msg.= "Valor".'<br>';
       }
       if(!$this->cotacao){
           $msg.= "Cotacao".'<br>';
       }
       if(!$this->moeda_de || !in_array($this->moeda_de, $moedas_aceitas)){
           $msg.= "Moeda a ser convertida".'<br>';
       }
       if(!$this->moeda_para || !in_array($this->moeda_para, $moedas_aceitas)){
           $msg.= "Moeda para qual será convertida".'<br>';
       }

       if($msg){
           echo "$msgHeader $msg";
           exit();
       }
   }
}