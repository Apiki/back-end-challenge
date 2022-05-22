<?php

namespace App\Entity\Money;

class BRL implements IMoney
{
    private $symbol = "R$";

    public function getSymbol()
    {
        return $this->symbol;
    }
}
