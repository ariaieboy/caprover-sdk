# CapRover SDK for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ariaieboy/caprover-laravel.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/caprover-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/ariaieboy/caprover-laravel.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/caprover-laravel)


[Caprover](https://github.com/caprover/caprover) is a "Free and Open Source PaaS".

You can interact with Caprover Api using this Package in your php projects.

## Installation

You can install the package via composer:

```bash
composer require ariaieboy/caprover-laravel
```

## Usage

#### step 1:

publish config file and set your credentials:

```bash
php artisan vendor:publish --tag="caprover-config"
```

This is the contents of the published config file:

```php
return [
    // you caprover main domain that poin to the admin area
    'server'=>env('CAPROVER_SERVER'),
    // the password of your caprover admin panel
    'password'=>env('CAPROVER_PASSWORD'),
    // guzzle timeout in seconds
    'timeout'=>env('CAPROVER_TIMEOUT',60)
];
```
you can use .env file instead:

```dotenv
#/.env file
CAPROVER_SERVER=YOUR_CAPROVER_MAIN_DOMAIN
CAPROVER_PASSWORD=YOUR_CAPROVER_PASSWORD
CAPROVER_TIMEOUT=60 #its the guzzle timeout in seconds
```

```php
$caproverLaravel = new Ariaieboy\Caprover();

// or you can use the CaproverLaravel facade

\Ariaieboy\CaproverLaravel\Facades\Caprover::method($args);
```
# ⚠️ Read this section before you use this package

this package using [Caprover-sdk](https://github.com/ariaieboy/caprover-sdk) in the background.

before using this package please read `caprover-sdk` [README.md](https://github.com/ariaieboy/caprover-sdk/tree/main#readme) README file for more details about available methods
and the limitations.

## Testing

we need some help for the testing part of this package. we will accept any PR for testing.


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [AriaieBOY](https://github.com/ariaieboy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
