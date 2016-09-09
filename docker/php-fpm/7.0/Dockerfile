FROM phpdockerio/php7-fpm:latest

# Install PHP extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.0-mysql php7.0-bcmath php7.0-mcrypt php7.0-mbstring php7.0-zip php7.0-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www/app"

