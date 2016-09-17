# docker-skeleton-php

*nginx, php, mysql*

## Usage

1. Copy `.env.dist` to `.env`.

    ```bash
    $ cp .env.dist .env
    ```

2. If you changed at least the `PROJECT_NAMESPACE` or `REPOSITORY_NAME` environment variables from the `.env` file, or you want choose a different version of php, then you need to run this script to build your own images. Otherwise you can skip this step.

    ```bash
    $ ./bin/build
    ```

3. Start the container.

    ```bash
    $ docker-compose up -d
    ```

4. Access your application via [http://localhost/](http://localhost/).

## Useful docker commands

```bash
# Start containers.
$ docker-compose up -d

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

# Removes stopped service containers. Any data which is not in a volume will be lost.
$ docker-compose rm
```

## F.A.Q.

* _How can I use Composer?_

    Run Composer through the `php` container:

    ```bash
    $ docker-compose run --rm php composer install
    ```

* _Can I use phpMyAdmin?_

    You can include `docker-compose.phpmyadmin.yml` with the other services. Run this:

    ```bash
    $ docker-compose -f docker-compose.yml -f docker-compose.phpmyadmin.yml up -d
    ```

    Then go to [http://localhost:8080/](http://localhost:8080/)

