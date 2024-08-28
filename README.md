# eMag-API-Test-Tool
 Tool for testing eMag API (because they don't provide any)

## Dependencies
* php
* [composer](https://getcomposer.org/)

## Install
```
composer update
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Showcase
dashboard
![dashboard](https://mihaicraciun88.github.io/eMag-API-Test-Tool/img/emag-test-api-dashboard.png)

users
![users](https://mihaicraciun88.github.io/eMag-API-Test-Tool/img/emag-test-api-users.png)

orders
![orders](https://mihaicraciun88.github.io/eMag-API-Test-Tool/img/emag-test-api-orders.png)

products
![products](https://mihaicraciun88.github.io/eMag-API-Test-Tool/img/emag-test-api-products.png)