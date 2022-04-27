<?php 
namespace Src;
	class Currency {
		protected $currencies;

		public function __construct() {
			$this->currencies = $this->setCurrencies();
		}
		private function setCurrencies() {
			return [
				['title' => 'BRL', 'symbol' => 'R$'], 
				['title' => 'USD', 'symbol' => '$'], 
				['title' => 'EUR', 'symbol' => '€']
			];
		}
		public function getCurrency($title) {
			$key = array_search($title, array_column($this->currencies, 'title'));
			if($key !== false) {
				return $this->currencies[$key];
			}
			return Output::invalidParameter('Moeda inválida');
		}
	}
?>
