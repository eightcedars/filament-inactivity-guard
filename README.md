# Filament idle/inactive session guard

[![Latest Version on Packagist](https://img.shields.io/packagist/v/eightcedars/filament-inactivity-guard.svg?style=flat-square)](https://packagist.org/packages/eightcedars/filament-inactivity-guard)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/eightcedars/filament-inactivity-guard/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/eightcedars/filament-inactivity-guard/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/eightcedars/filament-inactivity-guard/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/eightcedars/filament-inactivity-guard/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/eightcedars/filament-inactivity-guard.svg?style=flat-square)](https://packagist.org/packages/eightcedars/filament-inactivity-guard)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require eightcedars/filament-inactivity-guard
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-inactivity-guard-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-inactivity-guard-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-inactivity-guard-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentInactivityGuard = new EightCedars\FilamentInactivityGuard();
echo $filamentInactivityGuard->echoPhrase('Hello, EightCedars!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Emmanuel Nelson](https://github.com/eightcedars)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
