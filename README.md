# Filament idle/inactive session guard

[![Latest Version on Packagist](https://img.shields.io/packagist/v/eightcedars/filament-inactivity-guard.svg?style=flat-square)](https://packagist.org/packages/eightcedars/filament-inactivity-guard)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/eightcedars/filament-inactivity-guard/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/eightcedars/filament-inactivity-guard/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/eightcedars/filament-inactivity-guard/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/eightcedars/filament-inactivity-guard/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/eightcedars/filament-inactivity-guard.svg?style=flat-square)](https://packagist.org/packages/eightcedars/filament-inactivity-guard)



Guard your Filament dashboard from inactive sessions. Log users out after a 
predefined period of inactivity.

## Installation

You can install the package via composer:

```bash
composer require eightcedars/filament-inactivity-guard
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-inactivity-guard-views"
```

This is the contents of the published config file:

```php
return [
     /**
     * Determine if the plugin is enabled
     */
    'enabled' => true,

    /**
     * How long to wait before an idle session is considered inactive.
     * This value must be in seconds
     */
    'inactivity_timeout' => Carbon::SECONDS_PER_MINUTE * 14,

    /**
     * How long to show an inactive session notice before logging the user out.
     * This value must be in seconds
     *
     * Set this to null or 0 to disable the notice and log out immediately a user's session becomes inactive
     */
    'notice_timeout' => 60,

    /**
     * This package watches for a list of browser events to determine if a user is still active.
     * You may customise as desired.
     *
     * Ensure that the list is not empty
     */
    'interaction_events' => ['mousemove', 'keydown', 'click', 'scroll'],
];
```

Optionally, you can publish the translation files using

```bash
php artisan vendor:publish --tag="filament-inactivity-guard-translations"
```


## Usage

Add the plugin class to your panel ServiceProvider

```php
use EightCedars\FilamentInactivityGuard\FilamentInactivityGuardPlugin;

$panel
    ...
    ->plugin(FilamentInactivityGuardPlugin::make())
    ...
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

- [EightCedars](https://github.com/eightcedars)
- [Emmanuel Nelson](https://github.com/eyounelson)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
