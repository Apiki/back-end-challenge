<?php 
namespace Src;
require('currency.php');
use Src\Currency;
	class Exchange {
		protected $object;
		public function __construct($object) {
			$this->object = $object;
		}
		public function calculate() {
			if($this->verifyCurrencies() !== false) {
				return $this->makeExchange();
			}
			return false;
		}
		private function verifyCurrencies() {
			$currency = new Currency();
			$this->object['from'] = $currency->getCurrency($this->object['from']['value']);
			$this->object['to'] = $currency->getCurrency($this->object['to']['value']);
			return true;
		}
		private function makeExchange() {
			$response = [
				'valorConvertido' => $this->object['value']['value'] * $this->object['rate']['value'],
				'simboloMoeda' => $this->object['to']['symbol']
			];
			return $response;
		}
	}
?>
