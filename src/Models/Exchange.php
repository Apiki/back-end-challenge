<?php
    namespace App\Models;

    class Exchange {

      private $amount;
      private $from;
      private $to;
      private $rate;

      public function select(float $amount, string $from, string $to, float $rate) {
        $this->amount = $amount; 
        $this->from   = $from; 
        $this->to     = $to; 
        $this->rate   = $rate; 

        switch ($this->from) {
          case 'BRL':
            switch ($this->to) {
              case 'USD':
                return ['valorConvertido' => ($this->amount / $this->rate), 'simboloMoeda' => 'R$']; 
                break;
              case 'EUR':
                return ['valorConvertido' => ($this->amount / $this->rate), 'simboloMoeda' => 'R$']; 
                break;
              
              default:
                # code...
                break;
            }
            break;
          case 'USD':
            if ($this->to == 'BRL') {
              return ['valorConvertido' => ($this->amount * $this->rate), 'simboloMoeda' => '$']; 
            }
            break;
          case 'EUR':
            if ($this->to == 'BRL') {
              return ['valorConvertido' => ($this->amount * $this->rate), 'simboloMoeda' => 'Є']; 
            }
            break;
          
          default:
            # code...
            break;
        }
        return 20;
      }

    }