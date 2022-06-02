<?php declare( strict_types = 1 );
    /**
     * Class to solve o back end challenge
     *
     * PHP version 7.4
     *
     * @category Challenge
     * @package  Back-end
     * @author   Alexandre Almeida <xandy3br@gmail.com>
     * @license  http://opensource.org/licenses/MIT MIT
     * @link     https://github.com/apiki/back-end-challenge
     */

    namespace App;


    /**
     * Class Rules
     *
     * @category Challenge
     * @package  Back-end
     * @author   Alexandre Almeida <xandy3br@gmail.com>
     * @license  http://opensource.org/licenses/MIT MIT
     * @link     https://github.com/apiki/back-end-challenge
     */
final class Rules
{

    /**
     * * Rreturn Template
     *
     * @var array
     */
    public $return = [
        'valid'   => false,
        'code'    => 400,
        'message' => 'Oops, sorry there was an error!',
    ];

    /**
     ** Coin Type
     */
    const COINS = [
        'EUR' => [ 'BRL' ],
        'USD' => [ 'BRL' ],
        'BRL' => [
            'USD',
            'EUR',
        ],
    ];

    /**
     ** Currency symbols
     */
    const SYMBOLCOIN = [
        'EUR' => '€',
        'USD' => '$',
        'BRL' => 'R$',
    ];


    /**
     * Perform the validations, if passing returns data in array.
     *
     * @param string $amount Amount Value
     * @param string $from   From Coin
     * @param string $to     To Coin
     * @param string $rate   Rate Value

     * @return array|void
     */
    public function run(
        $amount,
        $from,
        $to,
        $rate
    ) : array {

        if (! ( $this->validIsNumber($amount) && $this->validIsNumber($rate) ) ) {
            $this->return[ 'message' ] = 'Invalid number';
        } elseif (! ( $this->validIsCoins($from, $to) ) ) {
            $this->return[ 'message' ] = 'Invalid currency';
        } else {
            $this->return = [
                'valid'           => true,
                'code'            => 200,
                'message'         => 'Success',
                'valorConvertido' => $this->calcRate($amount, $rate),
                'simboloMoeda'    => self::SYMBOLCOIN[ $to ],
            ];
        }

        return $this->return;
    }

    /**
     * * Valid currency type allowed
     *
     * @param string $value Value
     *
     * @return bool|void
     */
    public function validIsNumber( string $value ) : bool
    {

        if (empty($value) ) {
            return false;
        }

        return ! preg_match('/[^0-9.]+/', $value);
    }

    /**
     * * Valid currency type allowed
     *
     * @param string $from From Coin
     * @param string $to   To Coin
     *
     * @return bool
     */
    public function validIsCoins( string $from, string $to ) : bool
    {

        return isset(self::COINS[ $from ]) && in_array($to, self::COINS[ $from ]);
    }

    /**
     * * Calculates the fee amount
     *
     * @param string $amount Amount Value
     * @param string $rate   Rate Value
     *
     * @return float
     */
    public function calcRate( string $amount, string $rate ) : float
    {
        return $amount * $rate;
    }
}
