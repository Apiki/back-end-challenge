<?php

namespace Src\Tipos;

class TipoFloat extends Tipo {

    /**
     * @throws TipoException
     */
    public function validar() {
        if (!preg_match('/^[0-9]+(.[0-9]+)?$/', $this->valor)) {
            throw new TipoException(
                sprintf('O %s esta em formato inválido [0-9]+(.[0-9]+)?', 
                    empty($this->campos) ? 'valor ' .$this->valor : 'campo ' . $this->campo
                )
            );
        }        
    }

    /**
     * @return float
     */
    public function getValor() {
        return (float) $this->valor;
    }
}