<?php 
	class Output {
		protected $data;
		public function __construct($data) {
			$this->data = $data;
		}
		public function dataResponse() {
			header('Content-Type: application/json');
			header('HTTP/1.1 200');
	        $response['body'] = json_encode($this->data,  JSON_UNESCAPED_UNICODE);
	        echo $response['body'];
	        return $response;
		}
		public static function invalidParameter($message) {
			header('Content-Type: application/json');
	        header('HTTP/1.1 400');
	        $response['body'] = json_encode([
	            'error' => $message
	        ], JSON_UNESCAPED_UNICODE);
	        echo $response['body'];
	        exit();
		}

	}
?>