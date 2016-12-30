# Add PHPMyAdmin

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
