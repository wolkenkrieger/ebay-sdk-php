# ABOUT THIS REPOSITORY

This repository is a fork of another [eBay SDK repository](https://github.com/davidtsadler/ebay-sdk-php) and will be open-source and maintained on an unregular basis.

# EBAY-SDK-PHP

This project enables PHP developers to use the [eBay API](https://go.developer.ebay.com/api-documentation) in their PHP code, and build software using services such as [Finding](http://developer.ebay.com/Devzone/finding/Concepts/FindingAPIGuide.html), [Trading](http://developer.ebay.com/DevZone/guides/ebayfeatures/index.html), [Shopping](http://developer.ebay.com/Devzone/shopping/docs/Concepts/ShoppingAPIGuide.html), etc.

The SDK can be installed with [Composer](http://getcomposer.org).

## Features

  - Compatible with PHP 5.5 or greater.
  - Easy to install with [Composer](http://getcomposer.org/).
  - Compliant with [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/) and [PSR-4](http://www.php-fig.org/psr/psr-4/).

## Requirements

  - PHP 5.5 or greater with the following extensions:
      - cURL
      - libxml
  - 64 bit version of PHP recommended as there are some [issues when using the SDK with 32 bit](http://devbay.net/sdk/guides/getting-started/requirements.html#using-the-sdk-with-32-bit-systems).
  - SSL enabled on the cURL extension so that https requests can be made.

## Installation

The SDK can be installed with [Composer](http://getcomposer.org/). Please see the [Installation section of the User Guide](https://github.com/davidtsadler/ebay-sdk-php/wiki/Installation) to learn about installing through other means.

  1. Install Composer.

     ```
     curl -sS https://getcomposer.org/installer | php
     ```

  1. Install the SDK.

     ```
     php composer.phar require dts/ebay-sdk-php
     ```

  1. Require Composer's autoloader by adding the following line to your code.

     ```php
     require 'vendor/autoload.php';
     ```

## Example

### Get the official eBay time

```php
<?php

require 'vendor/autoload.php';

use \DTS\eBaySDK\Shopping\Services;
use \DTS\eBaySDK\Shopping\Types;

// Create the service object.
$service = new Services\ShoppingService();

// Create the request object.
$request = new Types\GeteBayTimeRequestType();

// Send the request to the service operation.
$response = $service->geteBayTime($request);

// Output the result of calling the service operation.
printf("The official eBay time is: %s\n", $response->Timestamp->format('H:i (\G\M\T) \o\n l jS Y'));
```

