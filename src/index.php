<?php
$paths = explode('/', $_SERVER['PATH_INFO']);
$symb=["$","€","R$"];
$setsymb;

$paths[4] == "BRL" ? $setsymb = $symb[2] :"";
$paths[4] == "EUR" ? $setsymb = $symb[1] :"";
$paths[4] == "USD" ? $setsymb = $symb[0] :"";

$resp = (object) array(
    "valorConvertido"=>$paths[2] * $paths[5],
    "simboloMoeda"=> $setsymb
);

echo '<script>console.log('.json_encode($resp).');</script>';
echo json_encode($resp);

?>
