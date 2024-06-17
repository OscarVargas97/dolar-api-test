# Usa la imagen oficial de PHP con las extensiones necesarias
FROM php:8.2-cli

# Establece el directorio de trabajo
WORKDIR /var/www

# Instala las dependencias del sistema necesarias, incluyendo apt-utils
RUN apt-get update && apt-get install -y \
    apt-utils \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos de la aplicación
COPY . .

# Instala las dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Optimiza la autoload de Composer
RUN composer dump-autoload

# Expone el puerto que usará php artisan serve
EXPOSE 8000

# Comando para iniciar la aplicación
CMD php artisan serve --host=0.0.0.0 --port=8000