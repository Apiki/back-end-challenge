<?php
    namespace App\Models;

    class Dinheiro{

		private $valor;
		private $simbolo;

		public function setValor($valor){
			return $this->valor = $valor;
		}

		public function setSimbolo($simbolo){
			return $this->simbolo = $simbolo;
		}
		public function getValor(){
		  return $this->valor;
		}
		public function getSimbolo(){
		  return $this->simbolo;
		}

        
	}

    class Coins{

		public static function convert(array $moeda) {
            $value = new Dinheiro();
            if($moeda[0] < 0 || $moeda[3] < 0 || empty($moeda[0]) || empty($moeda[3]) ){
                http_response_code(400);
                echo json_encode(array('status' => 'error 6'));  
                exit;
            }
            
            if($moeda[1] == 'BRL' && $moeda[2] == 'USD'){
                $value->setValor($moeda[0] * $moeda[3]);
                $value->setSimbolo("$");
            }elseif($moeda[1] == 'USD' && $moeda[2] == 'BRL'){
                $value->setValor($moeda[0] * $moeda[3]);
                $value->setSimbolo("R$");
            }elseif($moeda[1] == 'BRL' && $moeda[2] == 'EUR'){
                $value->setValor($moeda[0] * $moeda[3]);
                $simbolo = "\xE2\x82\xAc";
                $value->setSimbolo($simbolo);
            }elseif($moeda[1] == 'EUR' && $moeda[2] == 'BRL'){
                $value->setValor($moeda[0] * $moeda[3]);
                $value->setSimbolo("R$");
            }else{
                http_response_code(400);
                echo json_encode(array('status' => 'error 4'));  
                exit;
            }
            return $value;
        }

        public static function error() {
            return "error";
        }
	}
