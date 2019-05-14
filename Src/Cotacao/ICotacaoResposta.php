<?php

namespace Src\Cotacao;

use Src\Tipos\TipoFloat;

interface ICotacaoResposta {

    /**
     * @param TipoFloat $valor
     * @param Moeda $moeda
     */
    public function __construct(TipoFloat $valor, Moeda $moeda);

    /**
     * @return TipoFloat
     */
    public function getValor();

    /**
     * @return Moeda
     */
    public function getMoeda();
}