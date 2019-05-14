<?php

namespace Src\Cotacao;

use Src\Tipos\TipoFloat;

class CotacaoResposta implements ICotacaoResposta {

    public $valor;
    public $moeda;

    public function __construct(TipoFloat $valor, Moeda $moeda) {
        $this->valor = $valor;
        $this->moeda = $moeda;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getMoeda() {
        return $this->moeda;
    }
}