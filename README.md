# Billingo API v3 integráció

Billingo API integrációt lehetővé tevő library.

Aktuális API verzió: 3.0.14 (https://app.swaggerhub.com/apis/Billingo/Billingo/3.0.14)

## Telepités

Library telepitése composer segitségével:

```
composer require "richardeszeshu/billingo"
```

## Beállitás

### Laravel

Sikeres telepités után a konfigurációs állomány publikálása Laravelen:

```
php artisan vendor:publish
```

A projekt .env állományába fel kell venni a következő beállitásokat:

`BILLINGO_APIKEY` - a Billingo felületén kigenerált API kulcs
`BILLINGO_BLOCKID` - a számlázáshoz használatos bizonylattömb API ID-ja

### Egyéb rendszeren

## Használat

### Laravel

```php
    app()->get('Billingo')->getDocuments();
```