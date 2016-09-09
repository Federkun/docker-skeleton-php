FROM phpdockerio/php56-fpm:latest

# Install PHP extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install php5-mysql php5-bcmath php5-mcrypt php5-mbstring php5-zip php5-gd php5-xdebug \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/var/www/app"

