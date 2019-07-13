<!DOCTYPE html>
<html lang="pt-BR">

<head>
   <meta charset="UTF-8">
   <title>Desafio-Apiki</title>
</head>

<body>
   <?php
   require('moeda.php');

   $moeda = $_POST['conversao'];
   if ($moeda == "real") {
      $real = new moeda();
      $real->setSimbolo('R$');
      $resultado = $real->converterMoeda($_POST['cotacao'], $_POST['valor-converter']);
   } elseif ($moeda == "dolar") {
      $dolar = new moeda();
      $dolar->setSimbolo('$');
      $resultado = $dolar->converterMoeda($_POST['cotacao'], $_POST['valor-converter']);
   } else {
      $euro = new moeda();
      $euro->setSimbolo('€');
      $resultado = $euro->converterMoeda($_POST['cotacao'], $_POST['valor-converter']);
   }

   echo '<p>';
   echo "$resultado";
   echo '</p>'
   ?>
</body>

</html>