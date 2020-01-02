<?php
/**
 * Created by Carlos Adriano Sousa
 * User: Carlos
 */

require_once 'app/classes/Moeda.php';

class Dolar extends Moeda
{
    protected $nome_moeda = 'Dólar Americano';
    protected $simbolo_moeda = '$';

}