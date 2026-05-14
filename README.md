# Back-end Challenge — Apiki

REST API de conversão de moedas. Implementação em PHP 8.1+ orientada a objetos.

## Especificação atendida

Endpoint:

```
GET http://localhost:8000/exchange/{amount}/{from}/{to}/{rate}
```

Exemplo do enunciado:

```bash
curl http://localhost:8000/exchange/10/BRL/USD/4.50
```

Resposta:

```json
{
  "valorConvertido": 45,
  "simboloMoeda": "$"
}
```

Conversões suportadas: `BRL ⇄ USD` e `BRL ⇄ EUR`. Códigos são *case-sensitive* (`BRL`, `USD`, `EUR`).

## Como rodar

### Direto, como o avaliador faz

```bash
composer install
php -S localhost:8000 src/index.php
composer test    # Codeception (integração)
composer lint    # PHP_CodeSniffer (PSR-12)
```

### Via Docker (opcional)

```bash
docker compose up app                     # sobe a API em :8000
docker compose run --rm test              # roda Codeception
docker compose run --rm unit-test         # roda PHPUnit (extra)
docker compose run --rm lint              # roda phpcs
```

## Testes

- **15 testes Codeception** (`tests/ApiCest.php`) — cobrem os 4 caminhos de conversão exigidos pelo enunciado + todos os caminhos de erro (segmentos faltando, valor inválido, valor negativo, moeda inválida, rate inválida, rate negativa).
- **46 testes PHPUnit** (`tests-unit/`) — cobertura unitária de `Currency`, `Request` e `Exchange`.

## Estrutura

```
.
├── src/
│   ├── index.php             # entry point chamado por `php -S`
│   ├── Request.php           # parsing e validação da URI
│   ├── Currency.php          # enum das moedas (BRL, USD, EUR)
│   ├── ExchangeInput.php     # VO imutável (readonly)
│   ├── Exchange.php          # lógica de conversão
│   ├── ExchangeException.php # exception de domínio (HTTP 400)
│   └── Response.php          # output JSON
├── tests/
│   └── ApiCest.php           # testes de integração (composer test)
├── tests-unit/               # testes unitários (composer unit-test)
├── codeception.yml
├── phpunit.xml
├── phpcs.xml                 # regras PSR-12
├── composer.json
├── Dockerfile
└── docker-compose.yml
```

## Decisões de design

- **Validação no boundary, lógica pura no domínio.** `Request` valida a URI e produz um `ExchangeInput`. `Exchange` recebe um `ExchangeInput` já válido — não revalida, não faz I/O.
- **Enum + readonly VO.** Garantem em tempo de tipagem que só códigos válidos e dados imutáveis circulam entre as camadas.
- **`round($amount * $rate, 2)`** para evitar drift de ponto flutuante (e.g. `0.1 * 3 = 0.30000000000000004` em IEEE 754).
- **`JSON_THROW_ON_ERROR`** no encode para que falha de serialização vire `JsonException` capturável, e não um body vazio silencioso.
- **`ExchangeException` com `getCode() = 400`** para mapear direto pro status HTTP no `index.php`.
