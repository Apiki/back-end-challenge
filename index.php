

<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';


	class exchange {
		public function ConverterValores(){
			$valid = true;
			//CHECAR SE OS PARAMETROS FORAM PASSADOS
			if ( !isset($_GET['parametros']) ) $valid = false;
			
			$ar = explode("/", $_GET['parametros']);
			
			//CHECAR SE FORAM PASSADOS 4 PARAMETROS
			if ( count($ar) != 4 ) $valid = false;
			
			//CARREGAR OS PARAMETROS NAS VARIÁVEIS
			$amount	= $ar[0];
			$from 	= $ar[1];
			$to 	= $ar[2];
			$rate 	= $ar[3];
			
			//VALIDAR VALORES
			if ( !is_numeric($amount) ) $valid = false;
			if ( !is_numeric($rate) ) $valid = false;
			if ( strlen($from) != 3 ) $valid = false;
			if ( strlen($to) != 3 ) $valid = false;
			
			//PARAMETROS INVÁLIDOS: TERMINAR A EXECUÇÃO
			if ( !$valid ) {
				echo '400';
				return;
			}
			
			//CALCULAR O TOTAL
			$total = $amount * $rate;
			$total = number_format($total, 2, ',', '.');
			
			//DEFINIR SÍMBOLO DA MOEDA
			$simbolo = '-';
			if ( $to != "" ) {
				switch( $to ){
					case 'USD':
						$simbolo = '$';
						break;
					case 'BRL':
						$simbolo = 'R$';
						break;
					case 'EUR':
						$simbolo = '€';
						break;
				}
			}

			$vetor = array(
					'valorConvertido' => $total, 
					'simboloMoeda' => $simbolo
				);

			return json_encode($vetor);
		}
	}
	
	$obj_exchange = new exchange();
	
	$meu_json = $obj_exchange->ConverterValores();
?>
<?php echo $meu_json; ?>
