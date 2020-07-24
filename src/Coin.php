<?php

namespace App;

interface Coin
{
    public function setValue($value);
    public function getValue();
    public function getSymble();
    public function valueVerify($value);
}
