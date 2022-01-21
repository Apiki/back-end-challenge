<?php
    namespace App\Models;

    class Exchange {

      private $amount;
      private $from;
      private $to;
      private $rate;

      public function transaction(float $amount, string $from, string $to, float $rate) {
        $this->amount = $amount; 
        $this->from   = $from; 
        $this->to     = $to; 
        $this->rate   = $rate; 

        if ($this->from == 'EUR' || $this->from == 'USD') {
          $transaction['valorConvertido'] = $this->amount * $this->rate;
          if ($this->from == 'EUR') {
            $transaction['simboloMoeda'] = '€';
          }else{
            $transaction['simboloMoeda'] = '$';
          }
          return $transaction;
        }

        if ($this->from == 'BRL') {
          $transaction['valorConvertido'] = ($this->amount / $this->rate);
          $transaction['simboloMoeda'] = 'R$';
          return $transaction;
        }

        if ($this->from != 'EUR' || $this->from != 'BRL' || $this->from != 'USD') {
          return 'Defina uma moeda de origem válida';
        }
       
        if ($this->to != 'EUR' || $this->to != 'BRL' || $this->to != 'USD') {
          return 'Defina uma moeda de destino válida';
        }
      }

    }