<?php

namespace App\Entity\Money;

class EUR implements IMoney
{
    private $symbol = "€";

    public function getSymbol()
    {
        return $this->symbol;
    }
}
