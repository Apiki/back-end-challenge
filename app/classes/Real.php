<?php

require_once 'app/classes/Moeda.php';

class Real extends Moeda
{
    protected $nome_moeda = 'Real Brasileiro';
    protected $simbolo_moeda = 'R$';

}