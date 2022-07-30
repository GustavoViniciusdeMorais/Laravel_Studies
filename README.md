# Laravel Setup DockerFiles

I build this repository to save the setup for Laravel projects with my docker files.

Created by: Gustavo Vinicius

```
/etc/init.d/mysql stop

sudo docker-compose up -d --build
sudo docker exec -it [-u 0] [container_name] sh
sudo docker-compose down

sudo docker inspect [CONTAINER_ID] | grep IP

chmod +x composer.sh
./composer.sh

composer create-project laravel/laravel:^8.0 appname

cp -R appname/* .
rm -rf appname/

php artisan key:generate
```

### Laravel 9

- Configurations
    - Cop the .env file and setup the mysql IP container and auth data