# docker-skeleton-php

[![nginx](https://img.shields.io/badge/nginx-1.11-brightgreen.svg)]()
[![mysql](https://img.shields.io/badge/mysql-5.7-brightgreen.svg)]()
[![php5.6](https://img.shields.io/badge/php-5.6-brightgreen.svg)]()
[![php7.0](https://img.shields.io/badge/php-7.0-brightgreen.svg)]()
[![php7.1](https://img.shields.io/badge/php-7.1-brightgreen.svg)]()

## Usage

1. Copy `.env.dist` to `.env`:

    ```bash
    $ cp .env.dist .env
    ```

2. If you plan to use the [default docker repository](https://hub.docker.com/u/federkun/) to pull the Docker’s images, you can keep the default values of the `PROJECT_NAMESPACE` and `REPOSITORY_NAME` environment variables from the `.env` file and _skip this step_. Otherwise you need to build your own images. You can do that with:

    ```bash 
    $ ./bin/build
    ```

3. Start the container.

    ```bash
    $ docker-compose up -d
    ```

4. Access your application via [http://localhost/](http://localhost/).

## Documentation

- [Docker](#Docker)
    - [Useful docker commands](#Useful-docker-commands)
- [PHP](#PHP)
    - [Choose a different version of php](#Choose-a-different-version-of-php)
    - [Add PHPMyAdmin](#Add-PHPMyAdmin)
    - [Composer basic usage](#Composer-basic-usage)
    - [Create a new Symfony project](#Create-a-new-Symfony-project)
        - [Symfony console](#Symfony-console)

<a name="Docker"></a>
## Docker

<a name="Useful-docker-commands"></a>
### Useful docker commands

```bash
# Start containers.
$ docker-compose up -d

# Restart services.
$ docker-compose restart

# List containers.
$ docker-compose ps

# Start a terminal session for <container_name>.
$ docker exec -it <container_name> /bin/bash

# View logs.
$ docker-compose logs

# List/remove network.
$ docker network [ ls | rm <network_name> ]

# List/remove volumes.
$ docker volume [ ls | rm <volume_name> ]

# Stop containers.
$ docker-compose stop

# Stop and remove containers. Any data which is not in a volume will be lost.
$ docker-compose down
```

<a name="PHP"></a>
## PHP

<a name="Choose-a-different-version-of-php"></a>
### Choose a different version of php

By default `docker-compose.yml` uses the `latest` tag name of the php image which corresponds to php 7.1.

```yml
services:
  php:
    image: ${PROJECT_NAMESPACE}/${REPOSITORY_NAME}-php:latest
```

If you want a specific version of php, you can change it with one of those values: `5.6`, `7.0` or `7.1`. Example: 

```yml
  php:
    image: ${PROJECT_NAMESPACE}/${REPOSITORY_NAME}-php:5.6
```

The default docker repository already provides the images for those php version. Otherwise you need to build them by yourself with:

```bash 
$ ./bin/build
```

<a name="Add-PHPMyAdmin"></a>
### Add PHPMyAdmin

Edit `docker-compose.yml` and add a new service definition:

```yml
services:
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    ports:
     - "8080:80"
    environment:
      PMA_HOST: mysql
    networks:
      - backend
```

Then phpmyadmin will be accessible to [http://localhost:8080/](http://localhost:8080/)

<a name="Composer-basic-usage"></a>
### Composer basic usage

Place the `composer.json` file that describes the dependencies of your project inside the `app` folder, then install the defined dependencies through the `php` container:

```bash
$ docker-compose run --rm php composer install
```

<a name="Create-a-new-Symfony-project"></a>
### Create a new Symfony project

You can use Composer to ease the creation of a new symfony project:

```bash
$ rm -rf app/* && docker-compose run --rm -u $(id -u):$(id -g) php composer create-project symfony/framework-standard-edition .
```

As from [Symfony3.2](https://github.com/symfony/symfony/pull/19681) you can use the environment variables into you service container configuration, using the `%env(MYSQL_DATABASE)%` notation:

![Symfony config](https://cloud.githubusercontent.com/assets/21344385/21572074/ab2de672-ced5-11e6-83be-c4eb7274a900.png)

Composer will create a new [Symfony Standard Edition](https://github.com/symfony/symfony-standard) application under the `app/` directory.

A minimum configuration file to get your application running under Nginx is already provided from `docker-skeleton-php`.
Remove the `default.conf` file and rename `symfony.conf.example` into `symfony.conf`:

```bash
$ rm sites/default.conf
$ mv sites/symfony.conf.example sites/symfony.conf
```

Now remove the access check from `app/web/app_dev.php`:

```php
// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) || php_sapi_name() === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}
```

> **Warning**: After you deploy to production, make sure that you cannot access the `app_dev.php`

You can start the containers now:

```bash
$ docker-compose up -d
```

<a name="Symfony-console"></a>
#### Symfony console

How can I use Symfony's console?

 - For Symfony 3:

    ```bash
    $ docker-compose run --rm php php bin/console
    ```

 - For Symfony 2:

    ```bash
    $ docker-compose run --rm php php app/console
    ```
