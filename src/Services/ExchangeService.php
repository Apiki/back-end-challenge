<?php
    namespace App\Services;

    use App\Models\Exchange;

    class ExchangeService {
        public function get($amount, $from, $to, $rate) {
            if ($amount && $from && $to && $rate) {
                $exchange = new Exchange;
                return $exchange->transaction($amount, $from, $to, $rate);
            } 
        }
    }