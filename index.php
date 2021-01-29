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
 * @author   Kalil Maciel <kalilmaciel@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
/*declare(strict_types=1);

require __DIR__ . '/exchange/autoload.php';

chdir(__DIR__ . '/src/');

include_once __DIR__.'/index.php';*/


	class exchange {
		public function convertervalores(){
			$valid = true;
			//CHECAR SE OS PARAMETROS FORAM PASSADOS
			if ( !isset($_GET["parametros"]) ) $valid = false;
			
			$var = explode("/", $_GET['parametros']);
			
			//CHECAR SE FORAM PASSADOS 4 PARAMETROS
			if ( count($var) != 4 ) $valid = false;
			
			//CARREGAR OS PARAMETROS NAS VARIÁVEIS
			$amount	= $var[0];
			$from 	= $var[1];
			$to 	= $var[2];
			$rate 	= $var[3];
			
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
					'valorconvertido' => $total, 
					'simbolomoeda' => $simbolo
				);

			return json_encode($vetor);
		}
	}
	
	$obj_exchange = new exchange();
	
	$meu_json = $obj_exchange->convertervalores();
?>
<?php echo $meu_json; ?>
