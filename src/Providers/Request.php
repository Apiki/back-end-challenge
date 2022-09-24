<?php
/**
 * File Request.php /Providers
 *
 * PHP Version 8.1
 *
 * @category Providers
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace App\Providers;

/**
 * Abstract Request to api
 *
 * @category Providers
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
abstract class Request
{
    protected string $requestData;
    protected string $route;
    protected bool $error = false;
    protected array $message;
    
    /**
     * FormatedResponse prepare to response
     *
     * @return array
     */
    abstract public function formatedResponse() : array;
    
    /**
     * SetRequestData get from global
     *
     * @return void
     */
    public function setRequestData() : void
    {
        $this->requestData = $_SERVER['REQUEST_URI'];
    }
    
    /**
     * GetRoute return property
     *
     * @return string
     */
    public function getRoute() : string
    {
        return $this->route;
    }
    
    /**
     * GetRequestData return property
     *
     * @return string
     */
    public function getRequestData() : string
    {
        return $this->requestData;
    }
    
    /**
     * ValidRoute verify route request
     *
     * @return bool
     */
    public function validRoute() : bool
    {        
        if (strpos($this->requestData, $this->route) == false ) :
            return false;
        endif;

        return true;
    }

    /**
     * SendResults prepare to response api
     *
     * @return array error & validate | message
     */
    protected function sendResults() : array
    {
        if ($this->error == true ) :
            return [
                'error'   => true,
                'message' => $this->message
            ];
        endif;


        return [ 
            'error'            => false,
            'validatedRequest' => $this->formatedResponse()
        ];
    }
}