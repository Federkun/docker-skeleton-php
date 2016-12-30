# docker-skeleton-php

[![nginx](https://img.shields.io/badge/nginx-1.11-brightgreen.svg)]()
[![mysql](https://img.shields.io/badge/mysql-5.7-brightgreen.svg)]()
[![php5.6](https://img.shields.io/badge/php-5.6-brightgreen.svg)]()
[![php7.0](https://img.shields.io/badge/php-7.0-brightgreen.svg)]()
[![php7.1](https://img.shields.io/badge/php-7.1-brightgreen.svg)]()

## Usage

1. Copy `.env.dist` to `.env`.

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

## Choose a different version of php

By default `docker-compose.yml` uses the `latest` tag name of the php image which corresponds to php 7.1.

```yml
#
# Services definition
#
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

## Useful docker commands

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

# Stop and remove containers.
$ docker-compose down
```
