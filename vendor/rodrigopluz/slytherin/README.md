# Slytherin

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Slytherin is a simple and extensible PHP micro-framework that tries to achieve a [SOLID](https://en.wikipedia.org/wiki/SOLID_(object-oriented_design))-based design for creating your next web application. It uses [Composer](https://getcomposer.org) as the dependency package manager to add, update or even remove external packages.

## Install

Via Composer

``` bash
$ composer require rodrigopluz/slytherin
```

## Usage

### Using [ContainerInterface](src/Container/ContainerInterface.php)

``` php
// Define HTTP objects that is compliant to PSR-7 standards
$request = new Rodrigopluz\Slytherin\Http\ServerRequest($_SERVER);
$response = new Rodrigopluz\Slytherin\Http\Response(http_response_code());

// Create routes from Rodrigopluz\Slytherin\Rodrigopluz\RouterInterface...
$router = new Rodrigopluz\Slytherin\Rodrigopluz\Router;

$router->get('/', 'App\Http\Controllers\WelcomeController@index');

// ...then define it to Rodrigopluz\Slytherin\Rodrigopluz\DispatcherInterface
$dispatcher = new Rodrigopluz\Slytherin\Rodrigopluz\Dispatcher($router);

// Add the above objects through \Rodrigopluz\Slytherin\Container\ContainerInterface
$container = new Rodrigopluz\Slytherin\Container\Container;

$container->set('Psr\Http\Message\ServerRequestInterface', $request);
$container->set('Psr\Http\Message\ResponseInterface', $response);
$container->set('Rodrigopluz\Slytherin\Rodrigopluz\DispatcherInterface', $dispatcher);

// Lastly, run the application using the definitions from the container
(new Rodrigopluz\Slytherin\Application($container))->run();
```

### Using [IntegrationInterface](src/Integration/IntegrationInterface.php)

``` php
// Specify the integrations to be included and defined
$integrations = [];

$integrations[] = 'Rodrigopluz\Slytherin\Http\HttpIntegration';
$integrations[] = 'Rodrigopluz\Slytherin\Rodrigopluz\RodrigopluzIntegration';

// Create routes from Rodrigopluz\Slytherin\Rodrigopluz\RouterInterface
$router = new Rodrigopluz\Slytherin\Rodrigopluz\Router;

$router->get('/', 'App\Http\Controllers\WelcomeController@index');

// Supply values to integrations through Rodrigopluz\Slytherin\Configuration
$config = (new Rodrigopluz\Slytherin\Integration\Configuration)
    ->set('app.http.server', $_SERVER)
    ->set('app.router', $router);

// Run the application using the specified integrations and configuration
(new Rodrigopluz\Slytherin\Application)->integrate($integrations, $config)->run();
```

### Run the application using PHP's built-in web server:

``` bash
$ php -S localhost:8000
```

Open your web browser and go to [http://localhost:8000](http://localhost:8000).

### Required packages

* A [PSR-7](http://www.php-fig.org/psr/psr-7) compliant HTTP package
* A [PSR-11](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-container.md) compliant Container package
* Any route dispatching package, must be implemented in [`DispatcherInterface`](src/Rodrigopluz/DispatcherInterface.php)

Slytherin also provide implementations of the mentioned items above.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer require filp/whoops league/container nikic/fast-route phroute/phroute rdlowrey/auryn twig/twig zendframework/zend-diactoros zendframework/zend-stratigility --dev
$ composer test
```

## Security

If you discover any security related issues, please email rodrigopluz@gmail.com instead of using the issue tracker.

## Inspirations

* [Awesome PHP!](https://github.com/ziadoz/awesome-php) by [Jamie York](https://github.com/ziadoz)
* [Codeigniter](https://codeigniter.com) by [EllisLab](https://ellislab.com)/[British Columbia Institute of Technology](http://www.bcit.ca)
* [Crux](https://github.com/yuloh/crux) by [Matt A](https://github.com/yuloh)
* [Fucking Small](https://github.com/trq/fucking-small) by [Tony Quilkey](https://github.com/trq)
* [Laravel](https://laravel.com) by [Taylor Otwell](https://github.com/taylorotwell)
* [No Framework Tutorial](https://github.com/PatrickLouys/no-framework-tutorial) by [Patrick Louys](https://github.com/PatrickLouys)
* [PHP Design Patterns](http://designpatternsphp.readthedocs.org/en/latest) by [Dominik Liebler](https://github.com/domnikl)
* [PHP Standard Recommendations](http://www.php-fig.org/psr) by [PHP-FIG](http://www.php-fig.org)
* [Symfony](http://symfony.com) by [SensioLabs](https://sensiolabs.com)

## Credits

- [Rodrigopluz][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/rodrigopluz/slytherin.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/rodrigopluz/slytherin/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/rodrigopluz/slytherin.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/rodrigopluz/slytherin.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rodrigopluz/slytherin.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/rodrigopluz/slytherin
[link-travis]: https://travis-ci.org/rodrigopluz/slytherin
[link-scrutinizer]: https://scrutinizer-ci.com/g/rodrigopluz/slytherin/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/rodrigopluz/slytherin
[link-downloads]: https://packagist.org/packages/rodrigopluz/slytherin
[link-author]: https://github.com/rodrigopluz
[link-contributors]: ../../contributors