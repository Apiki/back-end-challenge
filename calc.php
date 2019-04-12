<?php
include("index.php");

if (!empty($_POST['valor1'])) {
    $val =floatval($_POST['valor1']);
    $tipo1 = $_POST['de'];
    $tipo2 = $_POST['para'];
    if ($tipo1 == 'Euro' && $tipo2 == 'Real') {
        $total = $val * 4.39;
        echo "O valor Convertido é: R$" .money_format('%#2n', $total);
    }
    if ($tipo1 == 'Dola' && $tipo2=='Real') {
        $total= $val * 3.88;
        echo "O valor convertido é: R$".money_format('%2n', $total);
    }
    if ($tipo1 == 'Euro' && $tipo2=='Dola') {
        $total= $val * 1.13;
        echo "O valor convertido é: USD".money_format('%2n', $total);
    }
    if ($tipo1 == 'Real' && $tipo2=='Euro') {
        $total= $val / 0.23;
        echo "O valor convertido é: EUD".money_format('%2n', $total);
    }
    if ($tipo1 == 'Real' && $tipo2=='Dola') {
        $total= $val / 0.26;
        echo "O valor convertido é: EUD".money_format('%2n', $total);
    }
    
}
