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

A Billingo API hivásokat megvalósitó osztály automatikusan elérhető a containerből Billingo néven. A service provider automatikusan inicializálja a megadott credential-ökkel, igy egyből használhatóak annak függvényei:

```php
app()->get('Billingo')->getDocuments();
```

### Egyéb rendszeren

Laraveltől eltérő keretrendszer használata esetén a `RichardEszes\Billingo\BillingoApi` osztály példányositandó.

```php
$billingoApi = new RichardEszes\Billingo\BillingoApi($baseUrl, $apiKey, $blockId);
```

Ezután használata a továbbiakban leirtak szerint történik, csupán a példában használt `app()->get('Billingo')` helyett ez a `$billingoApi` példányunk használandó:

```php
$partners = $billingoApi->partner()->list($params);
```

## Használat

Jelen verzióban az alábbi entitások kezelhetőek:

* partner
* product

Az entitások kezelése megegyezik, csupán a modellek attribútumaiban van eltérés.

A továbbiakban a példák a partnerek kezelését mutatja be, de ezek teljesen azonos módon kezelhetőek, csupán az entitás nevét kell kicserélni, pl:

```php
$partners = app()->get('Billingo')->partner($partner)->create();
```

helyett product esetén:

```php
$products = app()->get('Billingo')->product($product)->create();
```

A `list()` és a `getById()` függvények kivételével az összes műveletnél kötelező átadni az entitást.

### Listázás

```php
$partners = app()->get('Billingo')->partner()->list($params);
```

### Létrehozás

```php
$partner = new RichardEszes\Billingo\Models\Partner();
$partner->setName("John Doe")->setDiscount("percent", 10);
$partner->setAddress("HU", "1024", "Budapest", "Kis köz 17.");

$partner = app()->get('Billingo')->partner($partner)->create();
// $partner->id tartalmazza a partner Billingo-s ID-ját
```

### Lekérdezés

```php
$partner = app()->get('Billingo')->partner()->getById($partnerId);
// $partner egy Partner object, mely tartalmaz minden elérhető adatot
```

### Frissités

```php
$partner = new RichardEszes\Billingo\Models\Partner();
$partner->setId($ownPartnerModel->billingoId); // Billingo ID beállitása
$partner->setName("John Doe")->setDiscount("percent", 10);
$partner->setAddress("HU", "1024", "Budapest", "Kis köz 17.");

$partner = app()->get('Billingo')->partner($partner)->update();
// $partner egy Partner object, mely tartalmaz minden friss adatot
```

### Törlés

```php
$partner = new RichardEszes\Billingo\Models\Partner();
$partner->setId($ownPartnerModel->billingoId); // Billingo ID beállitása

$success = app()->get('Billingo')->partner($partner)->delete();
```