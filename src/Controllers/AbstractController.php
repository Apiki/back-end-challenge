<?php
/**
 * File AbstractController.php /Controllers
 *
 * PHP Version 8.0
 *
 * @category Controllers
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace App\Controllers;
use App\Providers\Response;
use App\Providers\Request;

/**
 * AbstractController Controller
 *
 * @category Controllers
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
abstract class AbstractController
{

    protected Request $request ;
    
    /**
     * __construct
     *
     * @param Request $request class
     * 
     * @return void
     */
    function __construct( $request = new Request() )
    {
        $this->request = $request;
    }
    
    /**
     * GetValidRequest return Request class property
     *
     * @return bool
     */
    public function getValidRequest() : bool
    {
        return $this->request->validRoute();
    }
    
    /**
     * Receiver must implements
     *
     * @param Request $request class
     * 
     * @return void
     */
    abstract public function receiver( Request $request ) : void;

    /**
     * SendResponse to prepare responsa to api
     *
     * @param object $code    to set header response
     * @param array  $message to print body's response
     * 
     * @return void
     */
    public function sendResponse( int $code, array $message ) : void
    {
        $response = new Response($code, $message);
        $response->sendResponse();
    }

}