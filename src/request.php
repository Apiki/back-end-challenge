<?php 
	class Request {
		protected $request;
		private $parameters, $currencyLenght = 3;
		public function __construct() {
			$this->setParameters();
		}
		private function setParameters() {
			$this->parameters = [
				['name' => 'exchange',  'position' => 0, 'type' => 'method'],
				['name' => 'value',  'position' => 1, 'type' => 'value'],
				['name' => 'from',  'position' => 2, 'type' => 'currency'],
				['name' => 'to',  'position' => 3, 'type' => 'currency'],
				['name' => 'rate',  'position' => 4, 'type' => 'value'],
			];
		}
		public function handleRequest() {
			$this->request = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
			if(count($this->request) == count($this->parameters)) { 
				return $this->generateDataObject();
			}
			return null;
		}
		private function generateDataObject() {
			$object = [];
			foreach($this->request as $key => $parameter) {
				$position = $this->getPosition($key, $parameter);
				$parameterName = $this->getParameterName($position);
				$object[$parameterName] = $this->parameters[$position];
				$object[$parameterName]['value'] = $parameter; 
			}
			return $object;
		}
		private function getParameterName($position) {
			return $this->parameters[$position]['name'];
		}
		private function getPosition($key, $parameter) {
			$position = array_search($key, array_column($this->parameters, 'position'));
			if($position !== false) {
				$this->checkParameter($this->parameters[$position], $parameter);
				return $position;
			}
			return Output::invalidParameter('Posição inválida');
		}
		private function checkParameter($expected, $request) {
			switch ($expected['type']) {
				case 'method':
					$this->verifyMethod($expected['name'], $request);
					break;
				case 'value':
					$this->verifyValue($request);
					break;
				case 'currency':
					$this->verifyCurrency($request);
					break;
				default:
					Output::invalidParameter('Parametros inválidos');
					break;
			}
		}	
		private function verifyMethod($method, $request) {
			return $request == $method ? true : Output::invalidParameter('Método inválido'); 
		}
		private function verifyValue($value) {
			return is_numeric($value) && $value > 0 ? true : Output::invalidParameter('Valor inválido');
		}
		private function verifyCurrency($data) {
			return mb_strlen($data) === $this->currencyLenght && ctype_upper($data) ? true : Output::invalidParameter('Moeda inválida');
		}
		
	}
?>