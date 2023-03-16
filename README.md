# Exchanges test project

# Установка
Клонируйте репозиторий на ваш локальный компьютер.
В папке проекта выполните команду ```composer install```, чтобы установить все зависимости.
Создайте новый файл .env в корневой директории проекта. 
Скопируйте содержимое файла .env.example в созданный вами файл .env.
```cp env.exampple .env```

Создайте новую базу данных в вашей СУБД и настройте соответствующие параметры в файле .env.

Сгенерируйте ключ:
```php artisan key:generate```

Выполните миграции и заполните таблицы данными командами:
```php artisan migrate --seed```

API Documentation
-----------------

### POST /api/create-exchange

Create an exchange.

#### Request

| Parameter | Type | Required | Description |
| --- | --- | --- | --- |
| seller_id | int | Yes | ID of the seller |
| currency_sell_id | int | Yes | ID of the currency to sell |
| currency_buy_id | int | Yes | ID of the currency to buy |
| sell_sum | float | Yes | Amount of currency to sell |
| buy_sum | float | Yes | Amount of currency to buy |

#### Response

| Status Code | Type | Description |
| --- | --- | --- |
| 200 | int | 1 if the exchange was successfully created |
| 400 | string | Error message if any of the required parameters are missing or invalid |

### POST /api/apply-exchange

Apply an exchange.

#### Request

| Parameter | Type | Required | Description |
| --- | --- | --- | --- |
| id | int | Yes | ID of the exchange to apply |
| buyer_id | int | Yes | ID of the buyer |

#### Response

| Status Code | Type | Description |
| --- | --- | --- |
| 200 | int | 1 if the exchange was successfully applied |
| 400 | string | Error message if any of the required parameters are missing or invalid |

### GET /api/get-exchanges

Get all exchanges for a given user.

#### Request

| Parameter | Type | Required | Description |
| --- | --- | --- | --- |
| user_id | int | Yes | ID of the user to get exchanges for |

#### Response

| Status Code | Type | Description |
| --- | --- | --- |
| 200 | array | An array of exchanges. Each exchange is an object with the following properties: sell_sum, price_with_fee, buyer_currency, seller_currency, seller_fname, seller_lname |
| 400 | string | Error message if any of the required parameters are missing or invalid |

### GET /api/get-fees

Get all fees for a given time period.

#### Request

| Parameter | Type | Required | Description |
| --- | --- | --- | --- |
| date_from | string | Yes | Start date of the time period in Y-m-d format |
| date_to | string | Yes | End date of the time period in Y-m-d format |

#### Response

| Status Code | Type | Description |
| --- | --- | --- |
| 200 | object | An object with the following properties: data (an array of objects with currency and amount properties) and status (always 200) |
| 400 | string | Error message if any of the required parameters are missing or invalid |