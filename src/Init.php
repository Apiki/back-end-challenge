<?php declare(strict_types=1);

    namespace App;

    /**
     * Class Init
     * @package App
     */
    final class Init extends Route {

        /**
         ** Load Rule Array
         * @var
         */
        private $__rule;

        /**
         ** Execute URI and Rules validation, if pass returns json
         * @return json
         */
        public function run() {
            if(!$this->validRoute()) {
                header($this->header);
                http_response_code($this->code);

            } elseif($this->validRules()) {
                header($this->header);
                http_response_code($this->code);
            }

            echo json_encode($this->response, JSON_UNESCAPED_SLASHES);
        }

        /**
         ** Valid Rules
         * @return bool
         */
        private function validRules(): bool {
            $valid = true;

            $rules = new Rules();

            $this->__rule = $rules->run($this->url[2], $this->url[3], $this->url[4], $this->url[5]);

            if($this->__rule['valid']) {
                $this->header = self::HTTP_200;
                $this->code   = self::CODE_200;
            }

            $this->response = $this->__rule;

            return $valid;
        }

    }