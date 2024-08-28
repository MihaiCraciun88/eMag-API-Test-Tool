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

## Features
* eMag API similar responses
* eMag API errors
* generate fake Orders, Customers and Products to test implementation

## Showcase
Dashboard
![dashboard](https://mihaicraciun88.github.io/eMag-API-Test-Tool/img/emag-test-api-dashboard.png)

Users
![users](https://mihaicraciun88.github.io/eMag-API-Test-Tool/img/emag-test-api-users.png)

Orders
![orders](https://mihaicraciun88.github.io/eMag-API-Test-Tool/img/emag-test-api-orders.png)

Products
![products](https://mihaicraciun88.github.io/eMag-API-Test-Tool/img/emag-test-api-products.png)