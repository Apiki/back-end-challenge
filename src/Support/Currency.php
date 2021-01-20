<?php


namespace App\Support;


/**
 * Class Currency
 * @package App\Support
 */
class Currency
{
    /** @var array */
    private $currencies = ["EUR", "BRL", "USD"];

    /**
     * @param array $data
     * @return bool
     */
    public function verify(array $data): bool
    {
        if ($data["amount"] <= 0 || $data["rate"] <= 0) {
            return false;
        }

        if (!in_array($data["from"], $this->currencies)) {
            return false;
        }

        if (!in_array($data["to"], $this->currencies)) {
            return false;
        }

        if ($data["from"] == "EUR" && $data["to"] == "USD" || $data["from"] == "USD" && $data["to"] == "EUR") {
            return false;
        }

        return true;
    }

    /**
     * @param array $data
     * @return array
     */
    public function convert(array $data): array
    {
        $convertedAmount = $data["amount"] * $data["rate"];
        $response = [
            'valorConvertido' => floatval(number_format($convertedAmount, 2)),
            'simboloMoeda' => $this->symbol($data["to"])
        ];

        return $response;
    }

    /**
     * @param string $currency
     * @return string
     */
    private function symbol(string $currency): string
    {
        if ($currency == "USD") {
            return "$";
        }
        if ($currency == "EUR") {
            return "€";
        }
        return "R$";
    }
}