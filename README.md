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

composer create-project laravel/laravel appname

cp -R appname/* .
rm -rf appname/
```

### Laravel 9

- Configurations
    - Config the database connection at the mysql flag in the config/database.php file