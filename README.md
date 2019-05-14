## Rodar o projeto
* instalar os pacotes do composer: **composer install**
* subir o servidor para testar: php -S localhost:8080 -t public

## Usar a api
http://localhost:8080/cotacao/{moeda do valor atual}/{moeda para qual deseja cotar}/{valor a ser cotado}

**ex:** http://localhost:8080/cotacao/brl/usd/1

```
{
    "valor": "0.25", \\O valor mudara de acordo com a cotação
    "simbolo": "$"
}
```
