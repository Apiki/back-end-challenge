<?php
/**
 * File Response.php /Providers
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
 * Response format response to api
 *
 * @category Providers
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class Response
{

    protected int $code;
    protected array $message;
    
    /**
     * __construct
     *
     * @param int   $code    verify to header
     * @param array $message sendo on body response
     * 
     * @return void
     */
    function __construct( int $code, array $message )
    {
        $this->code = $code;
        $this->message = $message;
    }
    
    /**
     * SendResponse set header and print body response
     *
     * @return void
     */
    public function sendResponse() : void
    {
        $this->setHeader($this->code);
        echo json_encode($this->message, JSON_UNESCAPED_UNICODE);
        exit();
    }
    
    /**
     * SetHeader do response
     *
     * @return void
     */
    protected function setHeader() : void
    {
        switch ($this->code) :
        case 200:
            header('HTTP/1.1 200 Unauthorized', true, 200);
            header('Content-Type: application/json; charset=utf-8');
            break;
            
        default:
            header('HTTP/1.1 400 error', true, 400);
            header('Content-Type: application/json; charset=utf-8');
            break;
        endswitch;
    }

}