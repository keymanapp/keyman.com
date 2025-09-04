# syntax=docker/dockerfile:1
FROM php:7.4-apache@sha256:c9d7e608f73832673479770d66aacc8100011ec751d1905ff63fae3fe2e0ca6d AS composer-builder

# Install Zip to use composer
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip

# Install and update composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update

USER www-data
WORKDIR /composer
COPY composer.* /composer/
RUN composer install

# Site
FROM php:7.4-apache@sha256:c9d7e608f73832673479770d66aacc8100011ec751d1905ff63fae3fe2e0ca6d
COPY resources/keyman-site.conf /etc/apache2/conf-available/
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN chown -R www-data:www-data /var/www/html/

# Because the base Docker image doesn't include locales, install these to generate locale files.
# gettext needed to compile .po files to .mo with msgfmt
RUN apt-get update && apt-get install -y \
    locales \ 
    gettext

# Install PHP-extension gettext for localization at runtime
RUN docker-php-ext-install gettext
RUN docker-php-ext-enable gettext

# Only enable en_US locale in /etc/locale.gen
# PHP will use textdomain() to specify "localization" .mo files
RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen \
    && dpkg-reconfigure --frontend=noninteractive locales \
    && update-locale

COPY --from=composer-builder /composer/vendor /var/www/vendor
RUN a2enmod rewrite headers; a2enconf keyman-site
