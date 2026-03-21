# Back-end Challenge

Desafio para os futuros programadores back-end da Apiki.

## Índice

- [Introdução](#introdução)
- [Instruções](#instruções)
- [Pré-requisitos](#pré-requisitos)
- [Dúvidas](#dúvidas)
- [Instalação e execução com Docker](#instalação-e-execução-com-docker)
- [Instalação e execução sem Docker (alternativa)](#instalação-e-execução-sem-docker-alternativa)

## Introdução

Desenvolva uma **REST API** que faça conversão de moedas.

**Especifícações**:

* A URL da requisição deve seguir o seguinte formato:
   * http://localhost:8000/exchange/{amount}/{from}/{to}/{rate}
   * http://localhost:8000/exchange/10/BRL/USD/4.50
* A resposta deve seguir o seguinte formato:
   ```json
   {
     "valorConvertido": 45,
     "simboloMoeda": "$"
   }
   ```
* Conversões:
    * De Real para Dólar;
    * De Dólar para Real;
    * De Real para Euro;
    * De Euro para Real;
* Serão executados testes automatizados para validação dos requisitos:
   * Levantar servidor embutido do PHP: `php -S localhost:8000 src/index.php`;
   * Executando testes: `composer test`;
   * Executando lint: `composer lint`;

## Instruções

1. Efetue o fork deste repositório e crie um branch com o seu nome e sobrenome. (exemplo: fulano-dasilva)
2. Após finalizar o desafio, crie um Pull Request.
3. Aguarde algum contribuidor realizar o code review.
 
*Obs.: Não esqueça de executar o `composer test` e `composer lint` localmente.*

## Pré-requisitos

* PHP => 7.4
* Orientado a objetos

## Dúvidas

Em caso de dúvidas, crie uma issue.

## Instalação e execução com Docker

Para facilitar a execução do projeto, foi disponibilizado um ambiente Docker.

*Obs.: A API estará disponível em `http://localhost:8000`.*

### Pré-requisitos

* Docker >= 20.10
* Docker Compose >= 1.29

### Instalação

**1 - Clonar o repositório:**

```sh
git clone git@github.com:Apiki/back-end-challenge.git
cd back-end-challenge
```

**2 - Subir o ambiente:**

```sh
docker-compose up
```

## Comandos Úteis Docker

```bash
# Para visualizar os comandos disponíveis
make help
```

```bash
# Para inicializar o ambiente e instalar as dependências
make start
```

```bash
# Para parar o ambiente
make stop
```

```bash
# Para executar os testes usando composer
make test
```

```bash
# Para executar o lint usando composer
make lint
```

---

### Execução sem Docker (alternativa)

```sh
composer install
php -S localhost:8000 -t src
```
