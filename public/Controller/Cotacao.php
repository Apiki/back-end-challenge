<?php

namespace Controller;

use Src\Cotacao\Moeda;
use Src\Tipos\TipoFloat;
use Src\Tipos\TipoException;
use Src\Cotacao\BancoCentral\Cotacao as CotacaoMoeda;


class Cotacao {
    
    public function cotar ($req, $res, $arg) {

        try {

            $de = new Moeda($arg['de']);
            $para = new Moeda($arg['para']);
            $valor = new TipoFloat($arg['valor']);

            $cotacao = new CotacaoMoeda();
            $cotar = $cotacao->cotar($de, $para, $valor);

            return $res->withJson([
                'valor' => number_format($cotar->getValor()->getValor(), 2, ',', '.'),
                'simbolo' => $cotar->getMoeda()->getSimbolo()
            ]);

        } catch ( \InvalidArgumentException $e) {
            return $res->withJson($e->getMessage(), 400);
        } catch ( TipoException $e) {
            return $res->withJson($e->getMessage(), 400);
        } catch (\Exception $e) {
            return $res->withJson('Ocorreu um erro inesperado!', 500);
        }

    }

}
