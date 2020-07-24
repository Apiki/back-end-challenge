<?php

namespace App;

interface Coin
{
    public function setValue($value);
    public function getValue();
    public function getSymbol();
    public function valueVerify($value);
}
