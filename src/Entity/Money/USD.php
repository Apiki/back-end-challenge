<?php

namespace App\Entity\Money;

class USD implements IMoney
{
    private $symbol = "$";

    public function getSymbol()
    {
        return $this->symbol;
    }
}
