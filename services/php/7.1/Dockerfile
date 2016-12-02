# Configuration from https://github.com/phpdocker-io/

FROM phusion/baseimage

# Change composer home directory
ENV COMPOSER_HOME /composer

# Allow composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install Ondrej repos for Ubuntu Xenial, PHP7.1, composer and selected extensions
RUN echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu xenial main" > /etc/apt/sources.list.d/ondrej-php.list \
    && echo "deb http://ppa.launchpad.net/ondrej/php-qa/ubuntu xenial main" > /etc/apt/sources.list.d/ondrej-php-qa.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C \
    && apt-get update \
    && apt-get -y --no-install-recommends install curl git ca-certificates php7.1-cli php7.1-fpm \
    php7.1-curl \
    php7.1-gd \
    php7.1-iconv \
    php7.1-intl \
    php7.1-json \
    php7.1-mbstring \
    php7.1-mcrypt \
    php7.1-mysql \
    php7.1-opcache \
    php7.1-readline \
    php7.1-sqlite \
    php7.1-xml \
    php7.1-zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* ~/.composer

# Configure FPM to run properly on docker
RUN sed -i "/listen = .*/c\listen = [::]:9000" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;access.log = .*/c\access.log = /proc/self/fd/2" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;clear_env = .*/c\clear_env = no" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/;catch_workers_output = .*/c\catch_workers_output = yes" /etc/php/7.1/fpm/pool.d/www.conf \
    && sed -i "/pid = .*/c\;pid = /run/php/php7.1-fpm.pid" /etc/php/7.1/fpm/php-fpm.conf \
    && sed -i "/;daemonize = .*/c\daemonize = no" /etc/php/7.1/fpm/php-fpm.conf \
    && sed -i "/error_log = .*/c\error_log = /proc/self/fd/2" /etc/php/7.1/fpm/php-fpm.conf \
    && usermod -u 1000 www-data

# Use baseimage-docker's init system.
CMD ["/sbin/my_init"]

# Add php config
COPY config/php.ini /etc/php/7.1/fpm/conf.d/99-custom.ini
COPY config/php.ini /etc/php/7.1/cli/conf.d/99-custom.ini

# Define php-fpm service
RUN mkdir /etc/service/php-fpm
ADD php-fpm.sh /etc/service/php-fpm/run

# Open fcgi port
EXPOSE 9000

WORKDIR "/var/www"
