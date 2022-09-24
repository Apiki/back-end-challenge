<?php
/**
 * File ExchangeService.php /Services
 *
 * PHP Version 8.0
 *
 * @category Services
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace App\Services;
use App\Services\Exchange\Controller\Exchange;
use App\Services\Exchange\ExchangeRequest;

/**
 * ExchangeService route
 *
 * @category Services
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class ExchangeService
{
    
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        $this->handleRequest($_SERVER['REQUEST_URI']);
    }
    
    /**
     * HandleRequest
     *
     * @param string $request to verify router
     * 
     * @return void
     */
    function handleRequest( string $request ) : void
    {
        $enchangeRequest = new ExchangeRequest();
        $exchangeController = new Exchange($enchangeRequest);

        if ($exchangeController->getValidRequest() == false ) :

            $error = [
                'errorItem' => 'Route',
                'message' => 'Wrong Route',
            ];
    
            $exchangeController->sendResponse(400, $error);

        endif;

        $exchangeController->receiver($enchangeRequest);
    }

}