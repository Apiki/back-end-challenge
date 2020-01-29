<?php
    use PHPUnit\Framework\TestCase;

    class ExchangeTest extends TestCase {

        public function testCheckIfFileExist() {
            $this->assertTrue(file_exists("src/Exchange.php"));
        }

        public function defineGet($from, $to) {
            $_GET['url'] = "10/".$from."/".$to."/3";
            $instance = new Exchange;
            $url = $instance->getUrl();

            $response = $instance->selectCurrency($url);

            return $response;
        }

        /**
         * @dataProvider instanceDataProvider
         */
        public function testInstanceWithIncorrectCurrencies($from, $to, $esperado) {
            $this->assertEquals($esperado, $this->defineGet($from, $to));
        }
        
        public function instanceDataProvider() {
            $result1 = array(
                "Error" => "Por favor, escolha uma das moedas (USD, EUR)"
            );

            $result2 = array(
                "Error" => "Por favor, escolha uma das moedas (BRL)"
            );

            $result3 = array(
                "Error" => "Por favor, escolha uma das moedas (BRL, USD, EUR)"
            );            

            return array(
                array("BRL", "asd", $result1),
                array("USD", "asd", $result2),
                array("EUR", "asd", $result2),
                array("asd", "asd", $result3),
            );
        }

        /**
         * @dataProvider convertDataProvider
         */
        public function testConvert($n1, $n2, $esperado) {
            $exchange = new Exchange;

            $this->assertEquals($esperado, $exchange->convert($n1, $n2));
        }

        public function convertDataProvider() {
            return array(
                array(3, 5, 15),
                array(3, 0, array(
                    "Error" => "Quantia e/ou taxa de câmbio inválida."
                )),
                array(1.4, 2.53, 3.542),
                array(2, -50, array(
                    "Error" => "Quantia e/ou taxa de câmbio inválida."
                ))
            );
        }
    }