<?php

namespace App\Controllers;

use App\Common\Http\{Request, Response};

class ErrorController implements IController
{
    public function handle(Request $request, Response $response, array $args)
    {
        echo json_encode(["Message" => "A página solicitada não existe :("]);
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus($args["code"])
            ->send();
    }
}
