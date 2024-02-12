# ipapi.co PHP

A simple API for ipapi.co using PHP

## Installation

Just require the package using composer.

```sh
composer require djonepl/ipapi-co-php
```

## Using the package

Just import, instantiate and call:

```php
<?php

use IpApi\IpApi;

$api = new IpApi();
$location = $api->lookup('ip');
```

### The \IpApi\Location object

The location object has an schema returned composed by the following fields by default:

ip
network
version
city
region
region_code
country
country_name
country_code
country_code_iso3
country_capital
country_tld
continent_code
in_eu
postal
latitude
longitude
timezone
utc_offset
country_calling_code
currency
currency_name
languages
country_area
country_population
asn
org

The location object has some others methods and features:

```php
$location = $api->lookup('8.8.8.8');

// Convert the object to an array
$data = $location->toArray();

// Extract city and ASN 
echo $location->city; // Mountain View
echo $location->asn; // AS15169

```
