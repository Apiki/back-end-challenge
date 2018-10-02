<?php


$api="sua chave aqui";   ///// Acesse  fixer.io api e coloque sua chave aqui


$string = file_get_contents("http://data.fixer.io/api/latest?access_key=68560fcb77d95b90848611c548443dfc&symbols=,EUR,USD,BRL");
	$json = json_decode($string, true);
	
	
	$i=0;
	foreach ($json['rates'] as $key => $value) {
		$currency[$i]=$key;
		$rate[$i]=$value;
		$i=$i+1;
				
	}
	
?>