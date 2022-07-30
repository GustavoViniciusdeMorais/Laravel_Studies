# Laravel Setup DockerFiles

I build this repository to save the setup for Laravel projects with my docker files.

Created by: Gustavo Vinicius

```
/etc/init.d/mysql stop

sudo docker-compose up -d --build
sudo docker exec -it [-u 0] [container_name] sh

chmod +x composer.sh
./composer.sh
```