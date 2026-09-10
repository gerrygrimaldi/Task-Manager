# Si crea un container in cui PHP 8.5 e Apache sono già installati, e si installano le estensioni necessarie per Laravel.
FROM php:8.5-apache

# Si installano le estensioni PHP necessarie per Laravel
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libicu-dev \
        libonig-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        intl \
        zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Installiamo Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Si imposta la directory di lavoro per Apache (si espone la directory public e non la root del progetto)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Si modifica la configurazione di Apache per utilizzare la directory impostata
RUN sed -ri \
        -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/sites-available/*.conf \
        /etc/apache2/apache2.conf \
        /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Si copiano i file del progetto Laravel nella directory di lavoro del container
COPY . .

# Si installano le dipendenze del progetto Laravel utilizzando Composer
RUN composer install --no-interaction --prefer-dist

# Si impostano i permessi corretti per le directory di storage e cache di Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Si espone la porta 80 per il traffico HTTP
EXPOSE 80

# Si avvia Apache in modalità foreground per mantenere il container in esecuzione
CMD ["apache2-foreground"]