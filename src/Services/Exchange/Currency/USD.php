<?php
/**
 * File USD.php /Services/Exchange/Currency
 *
 * PHP Version 8.0
 *
 * @category Services_Exchange_Currency
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace App\Services\Exchange\Currency;
use App\Entites\Currency;

/**
 * Service ExchangeRequest route
 *
 * @category Services_Exchange_Currency
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class USD extends Currency
{

    protected string $symbol = '$';
    
}