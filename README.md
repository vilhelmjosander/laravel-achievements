# Laravel Achievements

Simple, elegant Achievements the Laravel way.

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![StyleCI](https://styleci.io/repos/178260666/shield)](https://styleci.io/repos/178260666)
[![Quality Score](https://img.shields.io/scrutinizer/g/tehwave/laravel-achievements.svg?style=flat-square)](https://scrutinizer-ci.com/g/tehwave/laravel-achievements)
![Build Status](https://github.com/tehwave/laravel-achievements/workflows/tests/badge.svg)

## Requirements

The package has been developed and tested to work with the following minimum requirements:

- Laravel 5.8
- PHP 7.1

## Installation

Install the package via Composer.

```bash
composer require tehwave/laravel-achievements
```

Publish migrations.

```bash
php artisan vendor:publish --tag="achievements-migrations"
```

Migrate the migrations.

```bash
php artisan migrate
```

As an optional choice, you may publish config as well.

```bash
php artisan vendor:publish --tag="achievements-config"
```

## Usage

`Laravel Achievements` work much like Laravel's [notifications](https://laravel.com/docs/notifications).

```php
$user = \App\User::find(1);

$user->achieve(new \App\Achievements\UsersFirstPost());
```

### Creating Achievements

```bash
php artisan make:achievement UsersFirstPost
```

This command will place a fresh `Achievement` class in your new `app/Achievements` directory.

Each `Achievement` class contains a `toDatabase` method, that you may use to store additional data with the achievement, and a few properties for basic meta information.

### Unlocking Achievements

Use `Achiever` trait on models that can unlock achievements.

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use tehwave\Achievements\Traits\Achiever;

class User extends Model
{
    use Achiever;

    // ...
}
```

*Achieve* an achievement via the `achieve` method.

```php
$user = \App\User::find(1);

$user->achieve(new \App\Achievements\UsersFirstPost());
```

...or use `Achievement` class to unlock achievements.

```php
$user = \App\User::find(1);

\tehwave\Achievements\Achievement::unlock($user, new \App\Achievements\UsersFirstPost());
```

### Accessing Achievements

Retrieve all of the entity's unlocked achievements.

```php
$user = \App\User::find(1);

$user->achievements()->get();
```

## Tests

```bash
composer test
```

## Security

For any security related issues, send a mail to [peterchrjoergensen+achievements@gmail.com](mailto:peterchrjoergensen+achievements@gmail.com) instead of using the issue tracker.

## Changelog

See [CHANGELOG](CHANGELOG.md) for details on what has changed.

## Contributions

See [CONTRIBUTING](CONTRIBUTING.md) for details on how to contribute.

## Credits

- [Peter Jørgensen](https://github.com/tehwave)
- [All Contributors](../../contributors)

Inspired by https://github.com/gstt/laravel-achievements

## About

I work as a Web Developer in Denmark on Laravel and WordPress websites.

Follow me [@tehwave](https://twitter.com/tehwave) on Twitter!

## License

[MIT License](LICENSE)
