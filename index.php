<?php
	class exchange {
		public function converter_valores(){
			$ar = array();
			if ( isset($_SERVER['REQUEST_URI']) ) {
				$ar = explode("/", trim($_SERVER['REQUEST_URI'], '/'));
				
				//REMOVER O PARAMETRO EXCHANGE SE EXISTIR
				if (count($ar) > 0 && $ar[0]=='exchange') $ar = array_slice($ar, 1);
			}
			
			//CHECAR SE FORAM PASSADOS 4 PARAMETROS
			if ( count($ar) != 4 ) $this->abort();
			
			//CARREGAR OS PARAMETROS NAS VARIÁVEIS
			$amount	= $ar[0];
			$from 	= $ar[1];
			$to 	= $ar[2];
			$rate 	= $ar[3];
			
			//VALIDAR VALORES
			if ( !is_numeric($amount) ) $this->abort();
			if ( !is_numeric($rate) ) $this->abort();
			if ( strlen($from) != 3 ) $this->abort();
			if ( strlen($to) != 3 ) $this->abort();
			
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
		
		function abort() {
			echo '400';
			die();
		}
	}
	
	$obj_exchange = new exchange();
	
	$meu_json = $obj_exchange->converter_valores();
?>
<?php echo $meu_json; ?>
