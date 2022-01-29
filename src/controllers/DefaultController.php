<?php

namespace App\controllers;

use App\utils\Response;

class DefaultController
{
    /**
     * Define uma mensagem padrão quando não é acessado a URL de conversão.
     * @return void
     */
    public function defaultRoute()
    {
        Response::renderClientError();
    }
}
