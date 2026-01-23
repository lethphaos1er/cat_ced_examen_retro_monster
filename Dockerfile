FROM php:8.2-apache

# Activer mod_rewrite (OBLIGATOIRE pour Laravel)
RUN a2enmod rewrite

# Dépendances système + PHP extensions MySQL + PostgreSQL
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# DocumentRoot vers /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Copier le projet
COPY . /var/www/html
WORKDIR /var/www/html

# Permissions Laravel
RUN mkdir -p storage/logs storage/framework/{sessions,cache,views} \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Entrypoint Laravel
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
CMD ["/usr/local/bin/entrypoint.sh"]
