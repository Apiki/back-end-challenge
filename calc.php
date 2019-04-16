<?php
class moeda
{
    public function euro($euro)
    {
        return $euro = 4.40;
    }
    public function dolar($dolar)
    {
        return $dolar = 3.90;
    }
    public function dolae($eurodola)
    {
        return $eurodola=1.13;
    }
    public function realeuro($realeuro)
    {
        return $realeuro=0.23;
    }
    public function realdola($realdola)
    {
      return $realdola=0.26;  
    }
}

include('index.php');
$mod = new moeda();

if (!empty($_POST['valor1'])) {
    $val = floatval($_POST['valor1']);
    $tipo1 = $_POST['de'];
    $tipo2 = $_POST['para'];

    if ($tipo1 == 'Euro' && $tipo2 == 'Real') {
        $total = $val * $mod->euro($euro);
        echo "O valor Convertido é: R$" . money_format('%#2n', $total);
    }
    if ($tipo1 == 'Dola' && $tipo2 == 'Real') {
        $total = $val * $mod->dolar($dolar);
        echo "O valor convertido é: R$" . money_format('%2n', $total);
    }
    if ($tipo1 == 'Euro' && $tipo2 == 'Dola') {
        $total = $val * $mod->dolae($eurodola);
        echo "O valor convertido é: USD" . money_format('%2n', $total);
    }
    if ($tipo1 == 'Real' && $tipo2 == 'Euro') {
        $total = $val * $mod->realeuro($realeuro);
        echo "O valor convertido é: EUD" . money_format('%2n', $total);
    }
    if ($tipo1 == 'Real' && $tipo2 == 'Dola') {
        $total = $val * $mod->realdola($realdola);
        echo "O valor convertido é: EUD" . money_format('%2n', $total);
    }
}
