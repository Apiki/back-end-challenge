
<?php

/* http://localhost:8000/exchange/10/BRL/USD/4.50

...deve ser traduzido pelo servidor como:
http://localhost/exchange/index.php?amount=10&from=BRL&to=USD&rate=4.50

A conversão é feita pelo arquivo .htacces.
Conteúdo do .htaccess:

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^exchange/(.)/(.)/(.)/(.)$ index.php?amount=$1&from=$2&to=$3&rate=$4 [L,QSA]
*/

	class ClasseConversao {
		public function ConverterValores(){

            $amount = $_GET['amount'];                          //Parâmetro - Quantia
			$rate = $_GET['rate'];                              //Parâmetro - Moeda de desejada
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

   
