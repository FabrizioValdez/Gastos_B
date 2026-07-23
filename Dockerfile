FROM php:8.2-fpm

# Instalar dependencias del sistema y drivers de PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copiar el código del proyecto
COPY . .

# Instalar dependencias sin paquetes de desarrollo
RUN composer install --no-dev --optimize-autoloader

# Asignar permisos necesarios a Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 8080

# Iniciar servidor web dinámico para Render
CMD sh -c "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"