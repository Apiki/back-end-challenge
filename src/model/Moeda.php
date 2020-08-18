<?php

namespace Model;

class Moeda
{
    public function getMoeda($moeda)
    {
        switch($moeda){
            case "BRL":
                return "R$";
            break;
            case "USD":
                return "$";
            break;
            case "EUR":
                return "€";
            break;
        }
    }
}