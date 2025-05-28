FROM node:20-slim as node
FROM php:8.2-fpm

# Copiar node y npm desde la imagen de node
COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Configurar directorio de trabajo
WORKDIR /var/www

# Copiar archivos de package*.json primero para optimizar el cache de Docker
COPY package*.json /var/www/
RUN npm ci

# Copiar archivos de composer para optimizar el cache
COPY composer.* /var/www/
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts --no-autoloader

# Copiar el resto de los archivos
COPY . /var/www/

# Finalizar la instalación de composer
RUN composer dump-autoload --optimize

# Construir los assets
RUN npm run build

# Configurar permisos
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www

# Exponer puerto
EXPOSE 8000

# Comando para iniciar la aplicación
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
