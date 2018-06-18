<?php

include_once ('classe_conversor.php');

/*
Exemplo de consulta via url e query strings :

http://localhost/conversor/converte.php?valor=10&cotacao=3.70&de=dolar&para=real

*/

    $conv = new Conversor();

    $conv->cotacao=$_GET['cotacao'];
    $conv->valor=$_GET['valor'];
    $conv->moeda_de=$_GET['de'];
    $conv->moeda_para=$_GET['para'];
    $rs = $conv->converter();
    echo $rs;



