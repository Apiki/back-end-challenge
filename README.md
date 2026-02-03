# Desafio Back-end Apiki (Conversor de Moedas)

Este projeto é um desafio técnico para candidatos a desenvolvedor back-end, implementando uma API simples de conversão de moedas em PHP.

## Requisitos

- PHP >= 7.4
- Composer

## Instalação

1. Clone o repositório:
   ```sh
   git clone https://github.com/pedromarcusso09/back-end-challenge-pedromarcusso09
   cd back-end-challenge-pedromarcusso09
   ```
2. Instale as dependências:
   ```sh
   composer install
   ```

## Como executar

O endpoint principal está em `src/index.php` e espera requisições HTTP no seguinte formato:

```
/exchange/{valor}/{from}/{to}/{rate}
```

- `valor`: Valor a ser convertido (ex: 10)
- `from`: Moeda de origem (BRL, USD, EUR)
- `to`: Moeda de destino (BRL, USD, EUR)
- `rate`: Taxa de câmbio (ex: 0.2)

### Exemplo de requisição

```
GET /exchange/10/BRL/USD/0.2
```

Resposta:

```json
{
  "valorConvertido": 2,
  "simboloMoeda": "$"
}
```

### Erros comuns

- Parâmetros ausentes ou inválidos retornam HTTP 400 com mensagem de erro.
- Rota inexistente retorna HTTP 404.

## Testes

Os testes automatizados estão na pasta `tests/` e utilizam o Codeception.

Para rodar os testes:

```sh
vendor/bin/codecept run
```

## Scripts úteis

- `composer test` — Executa todos os testes
- `composer lint` — Verifica padrão de código
- `composer lint:fix` — Corrige automaticamente problemas de formatação
