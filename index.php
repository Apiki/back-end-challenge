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


	class minhaClasse {
		public function ConverterValores(){
			//DECLARAÇÃO E INICIALIZAÇÃO DE VARIÁVEIS
			$amount = 0;
			$from = "";
			$to = "";
			$rate = 0;
			$total = 0;
			$simbolo = '-';
			
			//CARREGAR VALORES
			if ( isset($_GET['amount']) ) {
				$amount = $_GET['amount'];
			}
			if ( isset($_GET['from']) ) {
				$from = $_GET['from'];
			}
			if ( isset($_GET['to']) ) {
				$to = $_GET['to'];
			}
			if ( isset($_GET['rate']) ) {
				$rate = $_GET['rate'];
			}
			
			if ( $amount > 0 && $rate > 0 ) {
				$total = $amount * $rate;
				$total = number_format($total, 2, ',', '.');
			}
			
			//DEFINIR SÍMBOLO DA MOEDA
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
	
	$fred = new minhaClasse();
	
	$meu_json = $fred->ConverterValores();
?>
<?php echo $meu_json; ?>
