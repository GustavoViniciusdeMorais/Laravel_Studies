# API Doc

<img src="./imgs/LumenAPI.png" width="500" height="300">

### Details
- [Package Configuration](./PackageConfiguration.md)
- REST JSON
- GraphQL
- [Queue Messaging (RabbitMQ)](./RabbitMQ.md)
- Mailhog

### Start project
```sh
docker compose up -d --build
chmod u+x startServices.sh
./startServices.sh
cd api
cp -R .env.example .env
```

### Config API Gateway
```sh
./dockermg.sh apigateway bash
cat nginx.conf > /etc/nginx/nginx.conf
nginx -t
service nginx start
```

## Tests

### User API
```sh
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"first_name":"test","last_name":"test","email":"test@email.com","password":"test"}' localhost/api/users

curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"email":"test@email.com","password":"test"}' localhost:81/api/users/login

token=""

curl -X GET -H "Authorization: Bearer $token" localhost:81/api/users/verify
```

### Articles GraphQL endpoint
```sh
cd cd modules/article/
vendor/bin/phpunit --filter GetArticlesGraphQlTest
```

### Test Queue Messagin
```sh
cd cd modules/article/
vendor/bin/phpunit --filter GetArticlesTest
cd ../../
php consumer.php
Access Mailhog at http://localhost:8025/
```

## Article Requests
### List Articles
```sh
curl -X GET http://localhost/api/articles
```
### Create Article
```sh
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"title":"New Article","body":"Lorem ipsum"}' \
  http://localhost/api/articles
```
### GraphQL Endpoint
```sh
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"query":"{ getArticles { uuid title body } }"}' \
  http://localhost/api/articles/graphql
```
