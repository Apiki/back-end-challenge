<?php

    namespace App\Services;
    
    use App\Models\Coins;

    class ExchangeService
    {
        public function get($moeda = null) 
        {
            if ($moeda) {
               return Coins::convert($moeda);
            } else {
                return Coins::error();
            }
        }

        public function post() 
        {
         
        }

        public function update() 
        {
            
        }

        public function delete() 
        {
            
        }
    }



