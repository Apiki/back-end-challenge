FROM php:7.4-cli

# Instala dependências básicas
RUN apt-get update && apt-get install -y \
    git unzip curl \
    && docker-php-ext-install pdo pdo_mysql

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /app

# Copia arquivos
COPY . .

# Instala dependências
RUN composer install --ignore-platform-reqs
# RODA O FIX AUTOMATICAMENTE
RUN composer fix || true

# Expõe porta
EXPOSE 8000

#  IMPORTANTE: usar index.php como router
CMD ["php", "-S", "0.0.0.0:8000", "-t", "src", "src/router.php"]