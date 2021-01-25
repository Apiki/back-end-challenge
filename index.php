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

class ClasseConversao {
		public function ConverterValores(){
			//return "teste";
			$amount = 0;
	
			$rate = 0;

			$simbolo = "";
			
			$to = "";
			
			if (isset($_GET['amount'])){
				$amount = $_GET['amount'];                          //Parâmetro - Quantia	
			}
			if (isset($_GET['rate'])){
				$rate = $_GET['rate'];                              //Parâmetro - Moeda de desejada
			}

			$total = $amount * $rate;                           //Parâmetro - Taxa da moeda desejada
			$total = number_format($total, 2, ',', '.');        //Parâmetro - Resultado
            $simbolo = '-';                                     //Parâmetro - Símbolo da moeda desejado
			
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

			$vetor = array(
					'valorConvertido' => $total, 
					'simboloMoeda' => $simbolo
				);

			return json_encode($vetor);
		}
	}
	
	$fred = new ClasseConversao();
	
	$meu_json = $fred->ConverterValores();
?>
	<pre>
		<?php var_dump($meu_json); ?>
	</pre>

   
