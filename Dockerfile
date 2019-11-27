FROM php:7.3-alpine
LABEL maintainer="Iago S."

RUN apk add --no-cache zlib-dev libzip-dev composer \
    && docker-php-ext-install zip

CMD [ "php", "-S", "localhost:8000", "index.php" ]