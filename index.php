<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';


	class exchange {
		public function converter_valores(){
			//CHECAR SE OS PARAMETROS FORAM PASSADOS
			if ( !isset($_GET['amount']) ) $this->abort();
			if ( !isset($_GET['from']) ) $this->abort();
			if ( !isset($_GET['to']) ) $this->abort();
			if ( !isset($_GET['rate']) ) $this->abort();
			
			//CARREGAR OS PARAMETROS NAS VARIÁVEIS
			$amount	= $_GET['amount'];
			$from 	= $_GET['from'];
			$to 	= $_GET['to'];
			$rate 	= $_GET['rate'];
			
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
