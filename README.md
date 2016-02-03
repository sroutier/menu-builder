# menu-builder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Via Composer

``` bash
$ composer require sroutier/menu-builder
```

## Declare provider

Add this declaration in the provider array of your `./config/app.php` file:

``` php
    ...
        Sroutier\MenuBuilder\Providers\MenuBuilderServiceProvider::class,
    ...
```

## Declare facade

Add this declaration in the aliases array of your './config/app.php' file:

```php
    ...
        'MenuBuilder' => Sroutier\MenuBuilder\Facades\MenuBuilderFacade::class,        
    ...
```

## Publish assets

You will have to publish at least the migration script, the seeding scripts and the route example, but following the 
instructions below:

To publish all assets, run this command:

``` bash
$ php artisan vendor:publish --provider="Sroutier\MenuBuilder\Providers\MenuBuilderServiceProvider"
```

To publish only the migrations, run this command:

``` bash
$ php artisan vendor:publish --provider="Sroutier\MenuBuilder\Providers\MenuBuilderServiceProvider" --tag="migrations"
```

To publish only the seeds, run this command:

``` bash
$ php artisan vendor:publish --provider="Sroutier\MenuBuilder\Providers\MenuBuilderServiceProvider" --tag="seeds"
```

To publish only the config, run this command:

``` bash
$ php artisan vendor:publish --provider="Sroutier\MenuBuilder\Providers\MenuBuilderServiceProvider" --tag="config"
```

To publish only the routes, run this command:

``` bash
$ php artisan vendor:publish --provider="Sroutier\MenuBuilder\Providers\MenuBuilderServiceProvider" --tag="routes"
```

To publish only the views, run this command:

``` bash
$ php artisan vendor:publish --provider="Sroutier\MenuBuilder\Providers\MenuBuilderServiceProvider" --tag="views"
```

## Setup the database

Run the migration script to create the database with this command:

``` bash
$ php artisan migrate
```

Then seed the database with at least the `root` menu entry taken from the seed files that you published as shown in 
the previous section. You could also edit the published seed files to add a few basic menu entries as shown in 
those files. To seed the database add this line to your main `database/seeds/DatabaseSeeder.php` file using 
the code below:

``` php
    $this->call('ProductionSeeder');
```

Once ready, call the artisan seed command:

``` bash
$ php artisan db:seed
```

**NOTE:** If you are in a development environment and want to create a few extra menu entries, have a look at the seed
file `MenuBuilderDevSeeder.php` that was publish along with the Prod file.


## Define routes

You must define the routes that you want to use, this task can be helped by publishing the routes as shown in 
the previous section. This will create a file called `routes-menu-builder.php` in the directory `app/Http` 
containing examples of routes needed for this package. You must configure your own routes by either copying and 
pasting the content of the routes file, in part or in it's entirety, to your routes file `app/Http/routes.php`, 
or you could include a reference to the published file by adding a this line:

```php
    require __DIR__.'/routes-menu-builder.php';
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email sroutier@gmail.com instead of using the issue tracker.

## Credits

- [Sebastien Routier][link-author]
- [All Contributors][link-contributors]

## License

The GNU General Public License Version 3 (GPLv3). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sroutier/menu-builder.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/licence-GPLv3-brightgreen.svg
[ico-travis]: https://img.shields.io/travis/sroutier/menu-builder/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/sroutier/menu-builder.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/sroutier/menu-builder.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sroutier/menu-builder.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sroutier/menu-builder
[link-travis]: https://travis-ci.org/sroutier/menu-builder
[link-scrutinizer]: https://scrutinizer-ci.com/g/sroutier/menu-builder/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/sroutier/menu-builder
[link-downloads]: https://packagist.org/packages/sroutier/menu-builder
[link-author]: https://github.com/sroutier
[link-contributors]: ../../contributors
