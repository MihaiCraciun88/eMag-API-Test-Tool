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
![dashboard](https://emag-api-testing-tool.github.io/img/emag-test-api-dashboard.png)

![users](https://emag-api-testing-tool.github.io/img/emag-test-api-users.png)

![orders](https://emag-api-testing-tool.github.io/img/emag-test-api-orders.png)

![products](https://emag-api-testing-tool.github.io/img/emag-test-api-products.png)