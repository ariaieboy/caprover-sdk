# a PHP SDK for CapRover api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ariaieboy/caprover-sdk.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/caprover-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/ariaieboy/caprover-sdk.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/caprover-sdk)

[Caprover](https://github.com/caprover/caprover) is a "Free and Open Source PaaS".

You can interact with Caprover Api using this Package in your php projects.

# ⚠️ Read this section before you use this package

according to this [section](https://github.com/caprover/caprover) the API of the Caprover is not documented anywhere.

`There is no official document for the API commands at this point as it is subject to change at any point.`

the line above is the exact sentence that Caprover team put in the api section of the `Caprover cli`.

because of this we can't guarantee that this sdk will work with all versions of the `Caprover`.

we will test each release of [`Caprover-Sdk`](https://github.com/ariaieboy/caprover-sdk) with the latest version of
the `Caprover` and we only guarantee that this package will work to the latest version.

the latest release is tested with [v1.10.1](https://github.com/caprover/caprover/releases/tag/v1.10.1) of the `Caprover`
.

## Installation

You can install the package via composer:

```bash
composer require ariaieboy/caprover-sdk
```

## Usage

```php


    try {
        $cs = new Ariaieboy\CaproverSdk\CaproverSdk();
        $res = $cs->method($vars);
    } catch (\Ariaieboy\CaproverSdk\Exceptions\InvalidCaproverServerInfoException $e) {
        //this exception happens when you put invalid Caprover information like ServerName or ServerPassword
    } catch (\Ariaieboy\CaproverSdk\Exceptions\CaproverErrorException $e) {
        /*
         * the code of the Caprover Error
         * for more info check CaproverApiStatus.php
         */
        echo $e->getCode();
        // the message of the error
        echo $e->getMessage();
    } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        //any guzzle error can be handeled here
    } catch (Exception $e) {
        //any other exception can be handeled here
    }
```

## Available Methods

```php
    /*
     * you can attach a custom domain to your apps
     * 
     * @return true on success
     */
    $cs->attachNewCustomDomainToApp("appName", "customDomain")
    /*
     * you can enable SSL for attached custom domain of your apps
     * 
     * @return true on success
     */
    $cs->enableSslForCustomDomain("appName", "customDomain")
    /*
     * you can remove attached custom domain to your apps
     * 
     * @return true on success
     */
    $cs->public function removeCustomDomain("appName", "customDomain")
```
more methods will be available in next releases.

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
