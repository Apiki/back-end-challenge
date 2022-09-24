<?php
/**
 * File ExchangeRequest.php /Services/Exchange
 *
 * PHP Version 8.0
 *
 * @category Services_Exchange
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace App\Services\Exchange;
use App\Providers\Request;

/**
 * ExchangeRequest
 *
 * @category Services_Exchange
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class ExchangeRequest extends Request
{
    protected string $route = 'exchange/';
    public array $request;
    protected array $acceptableCurrency = [
        'BRL',
        'USD',
        'EUR'
    ];
    
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        $this->setRequestData();
    }
    
    /**
     * FormatedResponse prepare data
     *
     * @return array
     */
    public function formatedResponse() : array
    {
        return [
            'amount' => $this->request[2],
            'from' => $this->request[3],
            'to' => $this->request[4],
            'rate' => $this->request[5],
        ];
    }
    
    /**
     * ValidateRequest
     * 
     * @return array sendResults functions
     */
    public function validateRequest() : array
    {
        $this->request = preg_split("/\//", $this->getRequestData());
        $formatedRequest = $this->formatedResponse();

        if (! $this->validateNumberParameters() ) :
            return $this->sendResults();
        endif;

        if (! $this->checkTypesRequest($formatedRequest) ) :
            return $this->sendResults();
        endif;

        if (! $this->checkAcceptableCurrency($formatedRequest) ) :
            return $this->sendResults();
        endif;

        return $this->sendResults();
    }

    /**
     * ValidateNumberParameters
     *
     * @return bool ? parameters
     */
    protected function validateNumberParameters() : bool
    {
        if (sizeof($this->request) < 6 ) :
            $this->error = true;
            $this->message = [
                'errorItem' => 'Number Parameters',
                'message' => 'Must have minimun 6 parameters'
            ];

            return false;
        endif;

        return true;
    }
    
    
    /**
     * CheckTypesRequest
     *
     * @param array $requestData after formatedResponse
     * 
     * @return bool
     */
    protected function checkTypesRequest( array $requestData ) : bool
    {
        $error = '';

        if (! is_numeric($requestData['amount']) || ($requestData['amount'] < 0) ) :
            $error = "Parameter 1 Request must be number and greater than 0";
        endif;

        if (! is_string($requestData['to']) || strlen($requestData['to']) <> 3) :
            $error = $error . "- Parameter 2 Request must be type of currency";
        endif;

        if (! is_string($requestData['from']) || strlen($requestData['from']) <> 3) :
            $error = $error . "- Parameter 3 Request must be type of currency";
        endif;

        if (! is_numeric($requestData['rate']) || ($requestData['rate'] < 0)) :
            $error = $error . "- Parameter 4 Request must be number greater than 0";
        endif;

        if (! empty($error) ) :
            $this->error = true;
            $this->message = [
                'errorItem' => 'Parameter',
                'message' => $error 
            ];
            return false;
        endif;

        return true;
    }

    
    /**
     * CheckAcceptableCurrency
     *
     * @param mixed $formatedRequest after formatedResponse
     * 
     * @return bool
     */
    protected function checkAcceptableCurrency( array $formatedRequest ) : bool
    {
        if (! in_array($formatedRequest['from'], $this->acceptableCurrency) ) :
            $this->error = true;
            $this->message = [
                'errorItem' => 'Currency',
                'message' => 'Parameter 3 Request must be acceptable currency'
            ];

            return false;
        endif;

        if (! in_array($formatedRequest['to'], $this->acceptableCurrency) ) :
            $this->error = true;
            $this->message = [
                'errorItem' => 'Currency',
                'message' => 'Parameter 4 Request must be acceptable currency'
            ];
            return false;
        endif;

        return true;
    }

}