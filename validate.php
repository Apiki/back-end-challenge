<?php 
require 'class/Conversor.php';
$conversor = new Conversor();

if(!empty($_POST['value']) && !empty($_POST['type_coin']) && !empty($_POST['to_convert']) && !empty($_POST['quotation']))
{
	$value = addslashes($_POST['value']);
	$type_coin = addslashes($_POST['type_coin']);
	$to_convert = addslashes($_POST['to_convert']);	
	$quotation = addslashes($_POST['quotation']);

	//Conversão de virgulas para ponto (Formato Brasileiro).
	$value = str_replace(",", ".", $value);
	$quotation = str_replace(",", ".", $quotation);

	//Verificando se o que foi informado pelo usuário é um número.
	if(is_numeric($value) && is_numeric($quotation)) {
		echo $conversor->convert($value, $type_coin, $to_convert, $quotation);
	} else {
		echo "Favor inserir números válidos...";
	}
}

?>