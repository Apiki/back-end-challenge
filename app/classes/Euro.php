<?php
/**
 * Created by Carlos Adriano Sousa
 * User: Carlos
 */

require_once 'app/classes/Moeda.php';

class Euro extends Moeda
{
    protected $nome_moeda = 'Euro';
    protected $simbolo_moeda = '€';

}