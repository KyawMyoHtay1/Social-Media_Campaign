FROM php:8.2-apache

RUN docker-php-ext-install mysqli \
    && (a2dismod mpm_event mpm_worker || true) \
    && a2enmod mpm_prefork rewrite

WORKDIR /var/www/html

COPY . /var/www/html

RUN mkdir -p /var/www/html/photos/profile_photos \
    && chown -R www-data:www-data /var/www/html/photos/profile_photos \
    && chmod -R 775 /var/www/html/photos/profile_photos

EXPOSE 80
