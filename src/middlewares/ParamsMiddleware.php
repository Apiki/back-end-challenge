<?php

namespace App\middlewares;

use Exception;
use \PlugRoute\Middleware\PlugRouteMiddleware;
use \PlugRoute\Http\Request;
use App\utils\Response;

class ParamsMiddleware implements PlugRouteMiddleware
{
    /**
     * Middleware para validar os parametros
     * @param Request $request
     * @return void
     */
    public function handler(Request $request): void
    {
        try {
            $amount = $request->parameter('amount');
            $from = $request->parameter('from');
            $to = $request->parameter('to');
            $rate = $request->parameter('rate');

            /** Validdte Amount */
            if (!is_numeric($amount) || $amount < 0) {
                throw new Exception();
            }

            /** Validate From */
            if (strlen($from) != 3 || !ctype_alpha($from)) {
                throw new Exception();
            }

            /** Validate To */
            if (strlen($to) != 3 || !ctype_alpha($to)) {
                throw new Exception();
            }

            /** Validdte Rate */
            if (!is_numeric($rate) || $rate < 0) {
                throw new Exception();
            }
        } catch (Exception $e) {
            Response::renderClientError();
            exit;
        }
    }
}
