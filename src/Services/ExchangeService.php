<?php
    namespace App\Services;

    use App\Models\Exchange;

    class ExchangeService {
        public function get($amount, $from, $to, $rate) {
            if ($amount && $from && $to && $rate) {
                $return = new Exchange;
                return $return->select($amount, $from, $to, $rate);
            } 
        }
    }