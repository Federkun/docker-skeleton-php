# docker-skeleton-php

*nginx, php, mysql*

## Usage

1. Copy `.env.dist` to `.env`

    ```bash
    $ cp .env.dist .env
    ```

2. Start the container.

    ```bash
    $ docker-compose up -d
    ```

3. Access your application via http://localhost:8080.

## Docker commands

```bash
# Rebuild services. Run if you change a service’s Dockerfile.
$ docker-compose build

# Start containers.
$ docker-compose up -d

# List containers.
$ docker-compose ps

# Start a terminal session for <container_name>.
$ docker exec -it <container_name> /bin/bash

# View logs
$ docker-compose logs

# Stop containers.
$ docker-compose stop

# Removes stopped service containers. Any data which is not in a volume will be lost.
$ docker-compose rm
```
