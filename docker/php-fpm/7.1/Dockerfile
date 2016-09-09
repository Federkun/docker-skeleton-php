FROM phpdockerio/php71-fpm:latest

# Install PHP extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.1-mysql php7.1-bcmath php7.1-mcrypt php7.1-mbstring php7.1-zip php7.1-gd \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www/app"

