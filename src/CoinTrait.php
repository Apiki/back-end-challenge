<?php

namespace App;

trait CoinTrait
{
    protected $value;
    
    public function setValue($value)
    {
        $this->value = $this->valueVerify($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    public function valueVerify($value)
    {
        if ((int) $value <= 0) {
            throw new \Exception("Error Processing Request", 1);
        }

        if ($value < 0) {
            throw new \Exception("Error Processing Request", 1);
        }

        return $value;
    }
}
