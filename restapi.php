<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Conversor de Moedas</h1>
        <form action="" method="GET">
            <label for="amount">Valor:</label>
            <input type="number" id="amount" name="amount" required>

            <label for="from">De:</label>
            <select id="from" name="from">
                <option value="BRL">Real (BRL)</option>
                <option value="USD">Dólar (USD)</option>
                <option value="EUR">Euro (EUR)</option>
            </select>

            <label for="to">Para:</label>
            <select id="to" name="to">
                <option value="USD">Dólar (USD)</option>
                <option value="BRL">Real (BRL)</option>
                <option value="EUR">Euro (EUR)</option>
            </select>

            <button type="submit">Converter</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['amount']) && isset($_GET['from']) && isset($_GET['to'])) {
            $amount = $_GET['amount'];
            $from = strtoupper($_GET['from']);
            $to = strtoupper($_GET['to']);

            class Conversor
            {
                private $amount;
                private $from;
                private $to;
                private $apiKey = '8fc59aea2bb3a3c73892727f'; // Sua chave de API

                public function __construct($amount, $from, $to)
                {
                    $this->amount = $amount;
                    $this->from = $from;
                    $this->to = $to;
                }

                public function converter()
                {
                    $rate = $this->obterTaxaCambio();
                    if ($rate === false) {
                        return [
                            'valorConvertido' => null,
                            'simboloMoeda' => '',
                            'erro' => 'Erro ao buscar a taxa de câmbio.'
                        ];
                    }

                    $valorConvertido = $this->amount * $rate;
                    $simboloMoeda = $this->obterSimboloMoeda($this->to);

                    return [
                        'valorConvertido' => $valorConvertido,
                        'simboloMoeda' => $simboloMoeda,
                        'erro' => ''
                    ];
                }

                private function obterTaxaCambio()
                {
                    $url = "https://v6.exchangerate-api.com/v6/{$this->apiKey}/latest/{$this->from}";
                    $response = @file_get_contents($url);

                    if ($response === FALSE) {
                        return false;
                    }

                    $data = json_decode($response, true);
                    return isset($data['conversion_rates'][$this->to]) ? $data['conversion_rates'][$this->to] : false;
                }

                private function obterSimboloMoeda($moeda)
                {
                    switch ($moeda) {
                        case 'USD':
                            return '$';
                        case 'BRL':
                            return 'R$';
                        case 'EUR':
                            return '€';
                        default:
                            return '';
                    }
                }
            }

            // Instanciar o conversor e exibir o resultado
            $conversor = new Conversor($amount, $from, $to);
            $resultado = $conversor->converter();

            if ($resultado['erro']) {
                echo "<div class='resultado'><p>{$resultado['erro']}</p></div>";
            } else {
                echo "<div class='resultado'>";
                echo "<p>Valor Convertido: {$resultado['simboloMoeda']} " . number_format($resultado['valorConvertido'], 2) . "</p>";
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>