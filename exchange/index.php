<?php

use App\Classes\Conversao;

$rTd = new Conversao();
$arr = explode('/',$_SERVER["REQUEST_URI"]);

$from = $arr[3];
$to = $arr[4];
$v1 = str_replace(",", '.', $arr[2]);
$v2 = str_replace(",", '.', $arr[5]);

echo "<br><br>";

switch ($rTd->tipo($from,$to)) {
    case 1:
        echo "#------------------- Conversão Real para Dólar -------------------#";
        echo '<br><br>';
        echo "#------ ".$rTd->realToDolar($v1,$v2)." -----#";
        echo '<br><br>';
        echo "#------------------- Conversão Real para Dólar -------------------#";
        break;
    case 2:
        echo "#------------------- Conversão Dólar para Real -------------------#";
        echo '<br><br>';
        echo "#------ ".$rTd->dolarToReal($v1,$v2)." -----#";
        echo '<br><br>';
        echo "#------------------- Conversão Dólar para Real -------------------#";
        break;
    case 3:
        echo "#------------------- Conversão Real para Euro -------------------#";
        echo '<br><br>';
        echo "#------ ".$rTd->realToEuro($v1,$v2)."-----#";
        echo '<br><br>';
        echo "#------------------- Conversão Real para Euro -------------------#";
        break;
    case 4:
        echo "-------------------- Conversão Euro para Real --------------------";
        echo '<br><br>';
        echo "#------ ".$rTd->euroToReal($arr[2],$arr[5])."-----#";
        echo '<br><br>';
        echo "#------------------- Conversão Euro para Real -------------------#";
        break;
    default:
        echo "i is not equal to 0, 1 or 2";
}
?>