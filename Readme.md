# Bank Management

### Setup application
```sh
sudo ./dockermg.sh -h
sudo ./dockermg.sh --start
sudo chmod -R 777 api/storage/
sudo ./dockermg.sh api bash
chmod u+x startServices.sh
./startServices.sh
cd api
php artisan migrate
php artisan db:seed
```

### Run tests
```sh
cd api
php artisan migrate:refresh
php artisan db:seed
vendor/bin/phpunit --filter AccountExistsTest
vendor/bin/phpunit --filter CreateAccountTest
vendor/bin/phpunit --filter GetAccountByIdTest
vendor/bin/phpunit --filter PurchaseDebitTest
vendor/bin/phpunit --filter PurchaseCreditTest
vendor/bin/phpunit --filter PixTransferTest
```

### Requests
```sh
curl --location 'localhost/api/accounts' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "test@gmail.com",
    "balance": 500
}'

curl localhost/api/accounts?id=1

curl --location 'localhost/api/transactions' \
--header 'Content-Type: application/json' \
--data '{"payment_type":"D","account_id":1, "value": 50}'

curl --location 'localhost/api/transactions' \
--header 'Content-Type: application/json' \
--data '{"payment_type":"C","account_id":1, "value": 100}'

curl --location 'localhost/api/transactions' \
--header 'Content-Type: application/json' \
--data '{"payment_type":"P","account_id":1, "value": 75}'
```
