FROM phpdockerio/php56-fpm:latest

# Add php config
COPY config/php.ini /etc/php5/fpm/conf.d/99-custom.ini

# Install PHP extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install php5-mysql php5-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www"

