<?php
$paths = explode('/', $_SERVER['PATH_INFO']);

function exchange($path) {

    $symb=["$","€","R$"];
    $setsymb;
    $path[4] == "BRL" ? $setsymb = $symb[2] :"";
    $path[4] == "EUR" ? $setsymb = $symb[1] :"";
    $path[4] == "USD" ? $setsymb = $symb[0] :"";
    
    
    $resp = (object) array(
        "valorConvertido"=>$path[2] * $path[5],
        "simboloMoeda"=> $setsymb
    );
    
    echo '<script>console.log('.json_encode($resp).');</script>';
    echo json_encode($resp);
    
    return json_encode($resp);
    
}

if ($paths[1] == "exchange") {
 
exchange($paths);
   
}

?>
