# Laravel columns

[![Latest Version on Packagist](https://img.shields.io/packagist/v/davide-casiraghi/laravel-columns.svg?style=flat-square)](https://packagist.org/packages/davide-casiraghi/laravel-columns)
[![Build Status](https://img.shields.io/travis/davide-casiraghi/laravel-columns/master.svg?style=flat-square)](https://travis-ci.org/davide-casiraghi/laravel-columns)
[![StyleCI](https://styleci.io/repos/192567464/shield?style=flat-square)](https://styleci.io/repos/192567464)
[![Quality Score](https://img.shields.io/scrutinizer/g/davide-casiraghi/laravel-columns.svg?style=flat-square)](https://scrutinizer-ci.com/g/davide-casiraghi/laravel-columns)
[![Coverage Status](https://scrutinizer-ci.com/g/davide-casiraghi/laravel-columns/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/davide-casiraghi/laravel-columns/)
<a href="https://codeclimate.com/github/davide-casiraghi/laravel-columns/maintainability"><img src="https://api.codeclimate.com/v1/badges/35d8c46b1641cd2b6bec/maintainability" /></a>
[![GitHub last commit](https://img.shields.io/github/last-commit/davide-casiraghi/laravel-columns.svg)](https://github.com/davide-casiraghi/laravel-columns) 


A Laravel library to generate responsive columns with multi language contents.

## Installation

You can install the package via composer:

```bash
composer require davide-casiraghi/laravel-columns
```
### Publish all the vendor files
```php artisan vendor:publish --force```

### Run the database migrations
```php artisan migrate```

## Usage

### Authorization
> To work the package aspect that in your user model and table you have a field called **group** that can have this possible values:
- null: Registered user 
- 1: Super Admin
- 2: Admin

> Just the users that have **Admin** and **Super admin** privileges can access to the routes that allow to create, edit and delete the blogs, categories and posts. Otherwise you get redirected to the homepage.

### Access to the package
After the package is published this new routes will be available:
- /columnGroups
- /columns

Accessing to this routes you can manage new column groups and columns.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email davide.casiraghi@gmail.com instead of using the issue tracker.

## Credits

- [Davide Casiraghi](https://github.com/davide-casiraghi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
