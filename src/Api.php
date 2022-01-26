<?php
namespace App;

/**
 * Manages api requests
 */
class Api {

    /* Currently requested URI */
    public $uri;

    /* Start router instance and proccess incoming data */
    public function __construct()
    {
        $request_uri = parse_url( $_SERVER['REQUEST_URI'] );
        $this->uri = trim( $request_uri['path'], '/' );
        $this->routes = array(
            '/^(?<uri>.*)$/' => array( __CLASS__, 'notFound' ),
        );
    }

    /* Return HTTP 400 code with a endpoint not found message */
    public function notFound( $matches ) : mixed
    {
        return [
            'data' => [
                'error' => sprintf( '<%s> is not a valid endpoint', $matches['uri'] )
            ],
            'code' => 400
        ];
    }

    /* Route matched request to it's mapped callback */
    public function route() : void
    {
        $uri = $this->uri;
        $routes = array_reverse( $this->routes );
        foreach( $routes as $pattern => $callback ) {
            if( preg_match( $pattern, $uri, $matches ) ) {
                $response = call_user_func( $callback, $matches );
                $this->response(
                    code : $response['code'],
                    data: $response['data']
                );
            }
        }
    }

    /* Return API data */
    public function response( mixed $data, int $code=200 ) : void
    {
        header( "Content-Type: application/json" );
        http_response_code( $code );
        $json_data = json_encode( $data );
        echo $json_data;
        die();
    }

}