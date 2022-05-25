<?php
/**
 * This file is the controller of api.
 *
 * @category Controllers.
 * @package  App\Controllers.
 * @author   Marcos Matos <marcosvm000@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     <https://www.linkedin.com/in/marcos-matos-47596a160/>
 */
namespace App\Controllers;

use App\Model\Exchange;

/**
 * Class ApiController
 *
 * @category Controllers.
 * @package  App\Controllers.
 * @author   Marcos Matos <marcosvm000@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     <https://www.linkedin.com/in/marcos-matos-47596a160/>
 * PHP version 7.4.
 */
class ApiController
{

    /**
     * Processes the request to get the endpoint.
     *
     * @param array $params The parameters of the request.
     *
     * @return void
     */
    public function processEndpoint(array $params = [] )
    {
        if ($params[1] === 'exchange') {
            $this->_exchangeEndpoint($params);
        }
    }

    /**
     * Endpoint for the exchange.
     *
     * @param array $params The parameters from the request.
     *
     * @return void
     */
    private function _exchangeEndpoint(array $params = [] )
    {
        $exchange = new Exchange($params[2], $params[3], $params[4], $params[5]);

        $response = $exchange->makeConversion();

        echo \GuzzleHttp\json_encode($response);
    }


}
