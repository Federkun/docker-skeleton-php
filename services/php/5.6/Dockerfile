# Configuration from https://github.com/phpdocker-io/

FROM debian:jessie

# Change composer home directory
ENV COMPOSER_HOME /composer

# Allow composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install dotdeb repo, PHP, composer and selected extensions
RUN apt-get update \
    && apt-get -y --no-install-recommends install curl git ca-certificates php5-cli php5-fpm \
    php5-curl \
    php5-gd \
    php5-intl \
    php5-json \
    php5-mcrypt \
    php5-mysql \
    php5-readline \
    php5-sqlite \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Configure FPM to run properly on docker
RUN sed -i "/listen = .*/c\listen = [::]:9000" /etc/php5/fpm/pool.d/www.conf \
    && sed -i "/;access.log = .*/c\access.log = /proc/self/fd/2" /etc/php5/fpm/pool.d/www.conf \
    && sed -i "/;clear_env = .*/c\clear_env = no" /etc/php5/fpm/pool.d/www.conf \
    && sed -i "/;catch_workers_output = .*/c\catch_workers_output = yes" /etc/php5/fpm/pool.d/www.conf \
    && sed -i "/pid = .*/c\;pid = /run/php/php5-fpm.pid" /etc/php5/fpm/php-fpm.conf \
    && sed -i "/;daemonize = .*/c\daemonize = no" /etc/php5/fpm/php-fpm.conf \
    && sed -i "/error_log = .*/c\error_log = /proc/self/fd/2" /etc/php5/fpm/php-fpm.conf \
    && usermod -u 1000 www-data

# The following runs FPM and removes all its extraneous log output on top of what your app outputs to stdout
CMD /usr/sbin/php5-fpm -F -O 2>&1 | sed -u 's,.*: \"\(.*\)$,\1,'| sed -u 's,"$,,' 1>&1

# Add php config
COPY config/php.ini /etc/php5/fpm/conf.d/99-custom.ini
COPY config/php.ini /etc/php5/cli/conf.d/99-custom.ini

# Working directory
WORKDIR "/var/www"

# Open fcgi port
EXPOSE 9000
