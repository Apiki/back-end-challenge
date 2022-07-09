# Back-end Challenge

Desafio back-end da Apiki.

## Introdução

A **REST API** desenvolvida faz a conversão de moedas.

## Instruções

1. Clonar o repositório: `git clone https://github.com/luispaiva/back-end-challenge`;
1. Troque de branch: `git checkout luis-paiva`;
2. Instalar as dependências utilizando composer: `composer install`;
3. Levantar servidor embutido do PHP: `php -S localhost:8000 index.php`; 
4. Executar o lint do código: `composer lint`;
5. Executar os testes: `composer test`;

**Especificações**:

* Para realizar os testes com o servidor web embutido do PHP, esse é o formato da URL:
   * http://localhost:8000/index.php/exchange/{amount}/{from}/{to}/{rate}
   * http://localhost:8000/index.php/exchange/10/BRL/USD/4.50

   <br>
   
   *Obs.: Você deve usar `index.php/exchange/10/BRL/USD/4.50` em vez de `exchange/10/BRL/USD/4.50` na URL para garantir que o servidor web embutido do PHP chame o arquivo principal index.php.*
   <br>

* Para realizar os testes em localhost, esse é o formato da URL:
   * http://localhost/back-end-challenge/exchange/{amount}/{from}/{to}/{rate}
   * http://localhost/back-end-challenge/exchange/10/BRL/USD/4.50
   
* A resposta segue o seguinte formato:
   ```json
   {
     "valorConvertido": 45,
     "simboloMoeda": "$"
   }
   ```

## Pré-requisitos

* PHP => 7.4