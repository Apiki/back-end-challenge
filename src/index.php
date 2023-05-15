
<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Clayton Santos Cordeiro <claytonsantos13@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends CI_Controller {
    
    public function exchange($amount, $from, $to, $rate){

        $convertedAmount = $amount * $rate;

        // Define o símbolo  
        $symbol = '';
        switch ($to) {
            case 'USD':
                $symbol = '$';
                break;
            case 'EUR':
                $symbol = '€';
                break;
            case 'BRL':
                $symbol = 'R$';
                break;
            default:
                $symbol = '';
                break;
        }

        $responsePayload = [
            'valorConvertido' => $convertedAmount,
            'simboloMoeda' => $symbol
        ];

        return response()->json($responsePayload);
    }
}
