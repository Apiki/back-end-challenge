<?php

namespace App\Controllers;

use App\Common\Http\{Request, Response};
use App\Services\ConvertMoney;

class ConvertMoneyController implements IController
{
    public function handle(Request $request, Response $response, array $args)
    {
        $service = new ConvertMoney();
        $result = $service->convert(
            $args["amount"], $args["from"], $args["to"], $args["rate"]
        );

        if (!$result) {echo json_encode(["Message" => "A Conversão não é permitida ou as moedas são inválidas"]);
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(400)
                ->send();
        }

        echo json_encode([
            "valorConvertido" => $result["value"],
            "simboloMoeda" => $result["symbol"]
        ]);

        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->send();
    }
}
