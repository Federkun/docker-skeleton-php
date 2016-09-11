FROM phpdockerio/php71-fpm:latest

# Add php config
COPY config/php.ini /etc/php/7.1/fpm/conf.d/99-custom.ini

# Install PHP extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.1-mysql php7.1-bcmath php7.1-mbstring php7.1-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www"

