<?php

namespace App\Helpers;

class ValidateEndpoint
{
    public static function routeHandler($response)
    {
        $response->getBody()->write(json_encode(['error'=> 'Bad Request']));
        return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400);
    }
}
