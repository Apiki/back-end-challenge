<?php declare( strict_types = 1 );
    /**
     * Class to solve o back end challenge
     *
     * PHP version 7.4
     *
     * @category Challenge
     * @package  Back-end
     * @author   Alexandre Almeida <xandy3br@gmail.com>
     * @license  http://opensource.org/licenses/MIT MIT
     * @link     https://github.com/apiki/back-end-challenge
     */

    namespace App;

    /**
     * Init Class
     *
     * @category Challenge
     * @package  Back-end
     * @author   Alexandre Almeida <xandy3br@gmail.com>
     * @license  http://opensource.org/licenses/MIT MIT
     * @link     https://github.com/apiki/back-end-challenge
     */
final class Init extends Route
{

    /**
     * Rule run
     */
    private $__rule;

    /**
     * Run Validates
     *
     * @return void
     */
    public function run()
    {
        if (! $this->validRoute() ) {
            header($this->header);
            http_response_code($this->code);

        } elseif ($this->validRules() ) {
            header($this->header);
            http_response_code($this->code);
        }

        echo json_encode($this->response, JSON_UNESCAPED_SLASHES);
    }


    /**
     * Procedure verify if request is correct, if not set response error
     *
     * @return bool
     */
    public function validRules() : bool
    {
        $valid = true;

        $rules = new Rules();

        $this->__rule = $rules->run(
            $this->url[ 2 ],
            $this->url[ 3 ],
            $this->url[ 4 ],
            $this->url[ 5 ]
        );

        if ($this->__rule[ 'valid' ] ) {
            $this->header = self::HTTP_200;
            $this->code   = self::CODE_200;
        }

        $this->response = $this->__rule;

        return $valid;
    }

}
