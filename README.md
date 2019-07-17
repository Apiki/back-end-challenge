# Back-end Challenge

Desafio para os futuros programadores back-end da Apiki.

## Introdução

Desenvolva uma **REST API** que faça conversão de moedas.

**Especifícações**:

* A requisição deve receber a cotação via parâmetro;
* A URL da requisição deve seguir o seguinte formato:
   * http://localhost/exchange/{amount}/{from}/{to}/{rate}
   * http://localhost/exchange/10/BRL/USD/4.50
* A resposta deve seguir o seguinte formato:
   ```json
   {
     "valorConvertido": 2.22,
     "simboloMoeda": "R$"
   }
   ```
* Conversões:
    * De Real para Dólar;
    * De Dólar para Real;
    * De Real para Euro;
    * De Euro para Real;

## Instruções

1. Efetue o fork deste repositório e crie um branch com o seu nome e sobrenome. (exemplo: fulano-dasilva)
2. Após finalizar o desafio, crie um Pull Request.
3. Aguarde algum contribuidor realizar o code review.

## Pré-requisitos

* PHP >= 5.6
* Orientado a objetos

## Dúvidas

Em caso de dúvidas, crie uma issue.
