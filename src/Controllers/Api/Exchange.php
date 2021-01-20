<?php


namespace App\Controllers\Api;


use App\Support\Currency;

class Exchange extends Api
{
    /**
     * __construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * index
     */
    public function index(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if (empty($data)) {
            $this->call(
                400)->back();

            return;
        }

        $currency = new Currency();
        if (!$currency->verify($data)) {
            $this->call(
                400)->back();

            return;
        }

        $this->back($currency->convert($data));
    }
}