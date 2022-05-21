<?php

namespace App\Controllers;

use App\Common\Http\Request;
use App\Common\Http\Response;

class ConvertMoneyController implements IController
{
    public function handle(Request $request, Response $response, array $args)
    {
        echo $request->getUri();
        dd($args);
    }
}
