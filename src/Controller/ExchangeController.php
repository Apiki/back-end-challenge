<?php

namespace App\Controller;

use App\Kernel\Http\AbstractResponse;
use App\Kernel\Http\JsonResponse;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Route;
use App\Service\Exchange\ConverterService;
use App\Service\Exchange\Coin\CoinBuilder;

class ExchangeController extends AbstractController
{
    protected static $prefix = '/exchange';

    public function run(RequestInterface $request): ?AbstractResponse
    {
        return $this->route(
            [
            new Route(
                '/{amount}/{from}/{to}/{rate}', 
                [$this, 'convert'], 
                $request
            )
            ]
        );
    }

    public function convert(string $amount, string $from, string $to, string $rate): AbstractResponse
    {
        try {
            $coinBuild = new CoinBuilder();
            $coin = $coinBuild->build($from, $amount);

            $converter = new ConverterService();
            $coin = $converter->convert($coin, $to, $rate);

            $response = new JsonResponse();
            return $response
                ->setStatus(200)
                ->setBody(
                    [
                    'valorConvertido' => $coin->getAmount(),
                    'simboloMoeda' => $coin->getSymbol()
                    ]
                );

        } catch(\Exception $e) {
            $response = new JsonResponse();

            return $response
                ->setStatus(400)
                ->setBody(
                    [
                    'error' => 'não foi possível realizar a operação',
                    'message' => $e->getMessage()
                    ]
                );
        }
    }
}
