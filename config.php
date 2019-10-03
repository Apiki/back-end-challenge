<?php
    require API ();

    $a = api ();

    $p->real = $_GET['real'];
    $p->dollar = $_GET['dollar'];
    $p->euro = $_GET['euro'];

    $convertido = $a-> conversor($p);

    echo json_encode ($convertido);

?>


