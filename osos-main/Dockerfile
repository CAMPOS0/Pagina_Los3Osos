FROM node:20-slim as node
FROM php:8.2-fpm

# Install nginx
RUN apt-get update && apt-get install -y nginx

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
    unzip \
    default-mysql-client

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Configurar directorio de trabajo
WORKDIR /var/www

# Copiar archivos de configuración primero
COPY package*.json vite.config.js tailwind.config.js postcss.config.js /var/www/
COPY composer.* /var/www/

# Instalar composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias de Node.js y PHP
RUN npm install && \
    composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts --no-autoloader

# Copiar el resto de los archivos del proyecto
COPY . /var/www/

# Crear directorios necesarios y configurar permisos
RUN mkdir -p /var/www/public/build && \
    chmod -R 777 /var/www/public/build && \
    chmod -R 777 resources

# Finalizar la instalación de composer y construir assets
RUN composer dump-autoload --optimize && \
    npm run build

# Configurar permisos
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www

# Configurar variables de entorno
RUN echo "APP_NAME=\"Los 3 Osos\"" > .env && \
    echo "APP_ENV=production" >> .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=\${RAILWAY_PUBLIC_DOMAIN}" >> .env && \
    echo "DB_CONNECTION=mysql" >> .env && \
    echo "DB_HOST=\${MYSQLHOST}" >> .env && \
    echo "DB_PORT=\${MYSQLPORT}" >> .env && \
    echo "DB_DATABASE=\${MYSQL_DATABASE}" >> .env && \
    echo "DB_USERNAME=\${MYSQLUSER}" >> .env && \
    echo "DB_PASSWORD=\${MYSQLPASSWORD}" >> .env && \
    echo "FILESYSTEM_DISK=public" >> .env && \
    echo "SESSION_DRIVER=cookie" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env && \
    echo "LOG_CHANNEL=stderr" >> .env && \
    echo "LOG_LEVEL=error" >> .env && \
    echo "BROADCAST_DRIVER=log" >> .env && \
    echo "SESSION_LIFETIME=120" >> .env && \
    echo "SESSION_SECURE_COOKIE=true" >> .env

# Generar clave de aplicación y optimizar
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Exponer puerto
EXPOSE 8000

# Copiar y configurar Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Script de inicio
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Comando para iniciar la aplicación
ENTRYPOINT ["docker-entrypoint.sh"]
