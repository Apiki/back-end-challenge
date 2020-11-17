<?php declare(strict_types=1);

    namespace App;


    /**
     * Class Rules
     * @package App
     */
    final class Rules {

        /**
         ** Rreturn Template
         * @var array
         */
        public $return = [
            'valid'   => false,
            'code'    => 400,
            'message' => 'Oops, sorry there was an error!',
        ];

        /**
         ** Coin Type
         *
         */
        const coins = [
            'EUR' => ['BRL'],
            'USD' => ['BRL'],
            'BRL' => ['USD', 'EUR'],
        ];

        /**
         ** Currency symbols
         *
         */
        const symbolCoin = [
            'EUR' => '€',
            'USD' => '$',
            'BRL' => 'R$',
        ];

        /**
         ** Perform the validations, if passing returns data in array.
         * @param  string  $amount
         * @param  string  $from
         * @param  string  $to
         * @param  string  $rate
         * @return array
         */
        public function run(string $amount, string $from, string $to, string $rate): array {

            if(!($this->validIsNumber($amount) && $this->validIsNumber($rate))) {
                $this->return['message'] = 'Invalid number';
            } elseif(!($this->validIsCoins($from, $to))) {
                $this->return['message'] = 'Invalid currency';
            } else {
                $this->return = [
                    'valid'           => true,
                    'code'            => 200,
                    'message'         => 'Success',
                    'valorConvertido' => $this->calcRate($amount, $rate),
                    'simboloMoeda'    => self::symbolCoin[$to],
                ];
            }

            return $this->return;
        }

        /**
         ** Valid currency type allowed
         * @param  string  $value
         * @return bool
         */
        private function validIsNumber(string $value): bool {

            if(empty($value)) {
                return false;
            }

            return !preg_match('/[^0-9.]+/', $value);
        }

        /**
         ** Valid currency type allowed
         * @param  string  $from
         * @param  string  $to
         * @return bool
         */
        private function validIsCoins(string $from, string $to): bool {

            return isset(self::coins[$from]) && in_array($to, self::coins[$from]);
        }

        /**
         ** Calculates the fee amount
         * @param  string  $amount
         * @param  string  $rate
         * @return float
         */
        public function calcRate(string $amount, string $rate): float {
            return $amount * $rate;
        }
    }