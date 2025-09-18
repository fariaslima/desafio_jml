FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    curl \
    git \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip exif pcntl

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o arquivo composer.json se houver
COPY composer.json /var/www/html/

# Instala as dependências do Laravel
RUN composer install --no-scripts --no-autoloader

# Copia o restante do código
COPY . .

# Executa o composer novamente para completar a instalação
RUN composer dump-autoload

# Expor a porta
EXPOSE 9000

# Comando para rodar o servidor do Laravel no contêiner (php artisan serve)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
