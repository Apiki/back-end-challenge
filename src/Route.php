<?php declare(strict_types=1);

    namespace App;


    /**
     * Class Route
     * @package App
     */
    class Route {

        /**
         * Const for return HTTP
         */
        const HTTP_200 = 'HTTP/1.1 200 OK';
        const HTTP_400 = 'HTTP/1.1 400 Bad Request';

        /**
         * Const for return code HTTP
         */
        const CODE_200 = 200;
        const CODE_400 = 400;

        /**
         ** Var global return
         * @var string[]
         */
        public $response = ['message' => ''];

        /**
         ** Message base for return
         * @var string
         */
        public $message = 'Ops! content not found.';

        /**
         *= Text pattern for Http
         * @var string
         */
        public $header = self::HTTP_400;

        /**
         *= Code pattern for Http
         * @var int
         */
        public $code = self::CODE_400;

        /**
         *= Variable URL Global
         * @var array
         */
        public $url;

        public function __construct() {

            //Get URL parameters
            $this->url = explode('/', $_SERVER['REQUEST_URI']);

        }

        /**
         ** Function to validate Route
         * @return bool
         */
        protected function validRoute(): bool {

            // Valid checks
            if(!($this->checkParameters() && $this->checkExchange() && $this->checkValue())) {
                return false;
            }

            return true;

        }

        /**
         ** Valid if there are parameters
         * @return bool
         */
        private function checkParameters(): bool {
            if(!(isset($this->url[1]) && isset($this->url[2]) && isset($this->url[3]) && isset($this->url[4]) && isset($this->url[5]))) {
                $this->header              = self::HTTP_400;
                $this->code                = self::CODE_400;
                $this->response['message'] = 'Insufficient parameters';

                return false;
            }

            return true;
        }

        /**
         ** Valid if exchange exists
         * @return bool
         */
        private function checkExchange(): bool {
            if(!(count($this->url) === 6 && isset($this->url[1]) && $this->url[1] === 'exchange')) {
                $this->header              = self::HTTP_400;
                $this->code                = self::CODE_400;
                $this->response['message'] = 'URL not found';

                return false;
            }

            return true;
        }

        /**
         ** Valid if there is value
         * @return bool
         */
        private function checkValue(): bool {
            if($this->url[2] <= 0 || $this->url[5] <= 0) {
                $this->header              = self::HTTP_400;
                $this->code                = self::CODE_400;
                $this->response['message'] = 'Invalid value';

                return false;
            }

            return true;
        }

    }
