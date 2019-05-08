<?php

include('Currency/Currency.php');

$from = $_GET['from'];
$to = $_GET['to'];
$amount = $_GET['amount'];

$params = [
  'from'=>$from,
  'to'=>$to,
  'amount' => $amount
];

// var_dump($params);
$currency = new Currency();
$converted = $currency->convert($params);
echo json_encode($converted);
