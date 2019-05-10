# Flads - Back-end Challenge

### Instruções básicas
- Existem 4 recursos, um para cada tipo de conversão.
- Nas conversões [dólar para real] e [real para dólar] utilize a cotação do dólar.
- Nas conversões [euro para real] e [real para euro] utilize a cotação do euro.
- Utilize uma vírgula como separador no caso de número decimal (na cotação por exemplo).
- Pode ser que você não consiga visualizar o símbolo do Euro (ou outro) corretamente. Isso acontece por conta do formato JSON. Entretanto isso é normal, não é um erro.

### Exemplo de requisição:
> [url]/[moeda-to-moeda]/[value]/[price]
- [url]: domínio que está sendo utilizado, no nosso caso estamos usando o "localhost" mesmo.
- [moeda-to-moeda]: de qual moeda para qual moeda o valor vai ser convertido.
- [value]: valor a ser convertido.
- [price]: cotação do dólar ou do euro.

### Exemplo de requisição feita usando o Postman:
![alt text](https://github.com/flads/back-end-challenge/blob/master/image-postman.png)

### 1. Clone este repositório
```
git clone https://github.com/flads/back-end-challenge.git
```
### 2. Instale as dependências
```
composer install
```
### 3. Execute o servidor. Caso tenha o PHP instalado, execute o servidor do PHP embutido
```
php -S localhost:8000
```