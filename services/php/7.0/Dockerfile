FROM phpdockerio/php7-fpm:latest

# Add php config
COPY config/php.ini /etc/php/7.0/fpm/conf.d/99-custom.ini

# Install PHP extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.0-mysql php7.0-bcmath php7.0-mbstring php7.0-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www"

