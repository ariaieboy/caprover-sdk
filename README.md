# CapRover SDK for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ariaieboy/caprover-sdk.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/caprover-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/ariaieboy/caprover-sdk.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/caprover-sdk)


[Caprover](https://github.com/caprover/caprover) is a "Free and Open Source PaaS".

You can interact with Caprover Api using this package in your PHP projects.

# ⚠️ Read this section before you use this package

According to this [section](https://github.com/caprover/caprover-cli#api), the API of the Caprover needs to be documented.

`There is no official document for the API commands at this point as it is subject to change at any point.`

The line above is the exact sentence the Caprover team put in the API section of the `Caprover CLI`.

Because of this, we can't guarantee that this SDK will work with all versions of the `Caprover`.

We will test each release of [`Caprover-Sdk`](https://github.com/ariaieboy/caprover-sdk) with the latest version of
the `Caprover`, and we only guarantee that this package will work with the newest version.

The latest release is tested with [v1.10.1](https://github.com/caprover/caprover/releases/tag/v1.10.1) of the `Caprover`
.

## Installation

You can install the package via Composer:

```bash
composer require ariaieboy/caprover-sdk
```

## Usage in Laravel

Publish config file and set your credentials:

```bash
php artisan vendor:publish --tag="caprover-config"
```

This is the contents of the published config file:

```php
return [
    // Your Caprover main domain that point to the admin area
    'server'=>env('CAPROVER_SERVER'),
    // The password of your Caprover admin panel
    'password'=>env('CAPROVER_PASSWORD'),
    // Guzzle timeout in seconds
    'timeout'=>env('CAPROVER_TIMEOUT',60)
];
```
You can use the .env file instead:

```dotenv
#/.env file
CAPROVER_SERVER=YOUR_CAPROVER_MAIN_DOMAIN
CAPROVER_PASSWORD=YOUR_CAPROVER_PASSWORD
CAPROVER_TIMEOUT=60 #its the guzzle timeout in seconds
```

```php
\Ariaieboy\CaproverLaravel\Facades\Caprover::method($args);
```

## Using In PHP Application
```php
$caprover = new \Ariaieboy\Caprover\Caprover('caprover address','caprover password','timeout (default:60)')

$caprover->method($args);
```

## Available Methods

```php
$caprover = new \Ariaieboy\Caprover\Caprover('server','password');

$caprover->getCaptainInfo();

/**
* You can retrieve the auth token for the API calls
 * but it's not necessary to call other methods
 * The SDK will handle getting API Auth Token for you.
 */
$caprover->getAuthToken();

//Attach a new domain to an app
$caprover->attachNewCustomDomainToApp(appName: string,customDomain: string);

//Enable SSL for a custom domain on an app
$caprover->enableSslForCustomDomain(appName: string,customDomain: string);

//Remove a Custom domain from an app
$caprover->removeCustomDomain(appName: string,customDomain: string);

//Force Ssl on captain root domain
$caprover->forceSsl(isEnabled: bool);

//Change Captain root domain
$caprover->updateRootDomain(rootDomain: string);

//Enable root domain SSL
$caprover->enableRootSsl(emailAddress: string);

//Get All Apps
$caprover->getAllApps();
```

## Testing

We are using Saloon as the base for our SDK, and for testing, we are using PestPHP.
To run available tests, you can run the tests using PestPHP CLI:
```bash
./vendor/bin/pest
```

We use Saloon `Recording Responses`, and because of that, if you run the available tests, you do not need to provide any caprover server for the tests.

You can run tests on a specific caprover server by creating a `.env` file in your tests folder.

We have an example `.env` file called `.env.example` that you can use to create your `.env` file.

For testing APIs that do operations on an app, you must provide a test app name from your caprover server using the `CAPROVER_TEST_APP` ENV variable.

And for testing the APIs that change an app's custom domain, you must provide a domain name that points to your caprover server using the `CAPROVER_TEST_DOMAIN` ENV variable.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for recent changes.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [AriaieBOY](https://github.com/ariaieboy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
