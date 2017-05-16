# Laravel DaData

Пакет работы с сервисом DaData.ru, для исправления синтаксических ошибок в информации контактных данных клиентов сайта и вывода подсказок поля форм.

## Установка
Добавить в composer.json в секцию "require":
```
"fomvasss/laravel-dadata": "^1.0",
```
и запустить:
```bash
composer update
```
или же просто запустить
```bash
composer require "fomvasss/laravel-dadata"
```
Зарегистрировать service-provider (config/app.php):
```php
  Fomvasss\Dadata\DadataServiceProvider::class,
```
Опубликовать конфиг: 
```bash
php artisan vendor:publish --provider="Fomvasss\Dadata\DadataServiceProvider" --tag="config"
```
Ввести токет (и ключ для API стандартизации) в config/dadata.php или .env
```php
    'token' => env('DADATA_TOKEN', ''),
    'secret' => env('DADATA_SECRET', ''),
```
## Использование
### Сервис подсказок (https://dadata.ru/api/suggest/)
Добавить в клас фасад:
```php
use Fomvasss\Dadata\Facades\DadataSuggest;
```
Пример использование метода с параметрамы:
```php
$result = DadataSuggest::suggest("address", ["query"=>"Москва", "count"=>2]);
print_r($result);
```
Первым параметором может быть: `fio, address, party, email, bank`

### Сервис стандартизации (https://dadata.ru/api/clean/)
Добавить в клас фасад:
```php
use Fomvasss\Dadata\Facades\DadataClean;
```
Использовать методы: 
```php
$response = DadataClean::cleanAddress('мск сухонска 11/-89');
$response = DadataClean::cleanPhone('тел 7165219 доб139');
$response = DadataClean::cleanPassport('4509 235857');
$response = DadataClean::cleanName('Срегей владимерович иванов');
$response = DadataClean::cleanEmail('serega@yandex/ru');
$response = DadataClean::cleanDate('24/3/12');
$response = DadataClean::cleanVehicle('форд фокус');
print_r($response);
```
### Проверка баланса системи
```php
$response = DadataClean::getBalance();
```


## Ссылки, документация, API:
- https://dadata.ru
- https://dadata.ru/api/clean
- https://confluence.hflabs.ru/display/SGTDOC172/REST+API
- https://gist.github.com/algenon/affa3f9fc7b665ab7744573455abe18d
- https://github.com/gietos/dadata
