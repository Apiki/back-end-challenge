
<?php
include('busca.php');

?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
	body{
		background-color: lavender;
		text-align: center;
		margin-top: 120px;
	}
	footer {
    font-size: 12px;
    margin: 0 auto;
    max-width: 1200px;
    position: relative;
    width: 95%;
}
body {
   background-image: url("imagem/imagem.jpg");
   background-color: #cccccc;
   background-repeat: no-repeat;
   background-size: auto;
}

}
</style>
<head>
	<title>Conversor de moeda</title>
</head>
<body>
	<h1>Conversor de moeda API</h1>
	
	
	<form method="post">
		Coloque o valor:
		<input type="text" name="amount" value="1"><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Moeda Inicial:
		<select name="from">
			<?php
				for($i=0;$i<count($rate);$i++){
					echo "<option value=\"$i\">$currency[$i]</option>";
				}


			?>
			
			</select> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Moeda Destino: <select name="to">
			<?php
				for($i=0;$i<count($rate);$i++){
					echo "<option value=\"$i\">$currency[$i]</option>";
				}


			?>
		</select><br><br>
		<input type="submit" name="submit" value="Converter!">
	</form>
	<br>
	<?php
	if (isset($_POST['amount'])) {
		$amount=$_POST['amount'];
		$from=$_POST['from'];
		$to=$_POST['to'];
		$combine= array_combine($currency, $rate);
		$from_currency=$rate[$from];
		$to_currency=$rate[$to];
		$result=$to_currency/$from_currency;
		$resultrev=$from_currency/$to_currency;
	$output=$result*$amount;
	$reverse=$resultrev*$amount;
	echo " Resultado da Coversão: <br><br> $amount $currency[$from] = "."$output $currency[$to]";

	echo "<br><br>Resultado Contrário:<br><br>$amount $currency[$to] = "."$reverse $currency[$from]";

	
	}

	?>
	<br>
	<br><br><br>
	
</body>


</html>