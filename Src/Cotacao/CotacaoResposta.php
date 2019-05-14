<?php

namespace Src\Cotacao;

use Src\Tipos\TipoFloat;

class CotacaoResposta implements ICotacaoResposta {

    /**
     * @var TipoFloat
     */
    public $valor;

    /**
     * @var Moeda
     */
    public $moeda;

    /**
     * @param TipoFloat $valor
     * @param Moeda $moeda
     */
    public function __construct(TipoFloat $valor, Moeda $moeda) {
        $this->valor = $valor;
        $this->moeda = $moeda;
    }

    /**
     * @return TipoFloat
     */
    public function getValor() {
        return $this->valor;
    }

    /**
     * @return Moeda
     */
    public function getMoeda() {
        return $this->moeda;
    }
}