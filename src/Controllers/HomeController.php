<?php

namespace App\Controllers;

use App\Common\Http\{Request, Response};

class HomeController implements IController
{
    public function handle(Request $request, Response $response, array $args)
    {
        echo json_encode(["Message" => "Use a url: /exchange/{amount}/{from}/{to}/{rate} para testar a API :)"]);
        return $response->withHeader('Content-type', 'application/json')->send();
    }
}
