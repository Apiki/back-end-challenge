<?php

namespace Src\Cotacao;

use Src\Tipos\TipoFloat;

interface ICotacao {

    /**
     * @param Moeda $de
     * @param Moeda $para
     * @param TipoFloat $valor
     * @return ICotacaoResposta
     * @throws InvalidArgumentException
     */
    public function cotar( Moeda $de, Moeda $para, TipoFloat $valor);
}