FROM php:8.2-apache

# Activer mod_rewrite (Laravel)
RUN a2enmod rewrite

# Dépendances système + libs pour MySQL et PostgreSQL + zip
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    libpq-dev \
    && docker-php-ext-install \
    pdo pdo_mysql pdo_pgsql pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Définir le DocumentRoot vers /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Copier le projet
COPY . /var/www/html

WORKDIR /var/www/html

# Permissions Laravel
RUN mkdir -p storage/logs storage/framework/sessions storage/framework/cache storage/framework/views \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R ug+rwx storage bootstrap/cache

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80
CMD ["apache2-foreground"]
COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"]
