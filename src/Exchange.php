<?php

namespace App;

class Exchange
{
    public function __construct(Coin $from, Coin $to, $rate)
    {
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
    }

    public function run() {
        return [
            'valorConvertido' => $this->from->getValue() * $this->rate,
            'simboloMoeda' => $this->to->getSymble(),
        ];
    }
}
