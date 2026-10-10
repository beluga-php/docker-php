# Docker PHP

Development has moved back to the original project at https://github.com/docker-php/docker-php.

**Docker PHP** (for lack of a better name) is a [Docker](http://docker.com/) client written in PHP.
This library aim to reach 100% API support of the Docker Engine.

The test suite currently passes against Docker Remote API v1.25 to v1.36.

[![Documentation Status](https://readthedocs.org/projects/docker-php/badge/?version=latest)](http://docker-php.readthedocs.org/en/latest/)
[![Latest Version](https://img.shields.io/github/release/beluga-php/docker-php.svg?style=flat-square)](https://github.com/beluga-php/docker-php/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/beluga-php/docker-php.svg?style=flat-square)](https://packagist.org/packages/beluga-php/docker-php)

## Installation

The recommended way to install Docker PHP is of course to use [Composer](http://getcomposer.org/):

```bash
composer require beluga-php/docker-php
```

## Docker API Version

By default it will use the last version of docker api available, if you want to fix a version (like 1.41) you can add this
requirement to composer:

```bash
composer require "beluga-php/docker-php-api:6.1.41.*"
```

## Usage

See [the documentation](http://docker-php.readthedocs.org/en/latest/).

## Unit Tests

Setup the test suite using [Composer](http://getcomposer.org/) if not already done:

```
$ composer install --dev
```

Run it using [PHPUnit](http://phpunit.de/):

```
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

This README heavily inspired by [willdurand/Negotiation](https://github.com/willdurand/Negotiation) by @willdurand. This guy is pretty awesome.

This library is a fork of the original [docker-php/docker-php](https://github.com/docker-php/docker-php), created by [Geoffrey Bachelet](https://github.com/ubermuda) and [Joel Wurtz](https://github.com/joelwurtz).

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
