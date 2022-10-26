<?php
/**
 * API Request
 *
 * PHP version 7.4
 *
 * @category Backend_Challenge
 * @package  Back-end-challenge
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/fabianoone/back-end-challenge
 */

 /**
  * Class Request
  *
  * @category Backend_Challenge
  * @package  Back-end-challenge
  * @author   Fabiano Oliveira <fabiano.one@gmail.com>
  * @license  MIT http://opensource.org/licenses/MIT
  * @link     https://github.com/fabianoone/back-end-challenge
  */
class Request
{
    /**
     * Handles the request and method
     *
     * @return array
     */
    public function getUrl()
    {
        $request = array_filter(explode('/', $_SERVER['REQUEST_URI']));
        $method = array_shift($request);
        return [$method, $request];
    }

    /**
     * Handles responses
     * Show error codes e messages
     *
     * @param ARRAY $response - response from the request
     *
     * @return VOID
     */
    public function sendResponse($response)
    {
        header('Content-Type:application/json');
        if (!$response) {
            $response['ERRO'] = 'Not allowed.';
        };

        if (isset($response['ERRO'])) {
            http_response_code(400);
        };

        echo json_encode($response);
    }
}
