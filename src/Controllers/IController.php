<?php

namespace App\Controllers;

use App\Common\Http\Request;
use App\Common\Http\Response;

interface IController
{
    public function handle(Request $request, Response $response, array $args);
}
