# Spark Plug

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Obtains an instance of [CodeIgniter](https://codeigniter.com/) gracefully.

## Install

Via Composer

``` bash
$ composer require rodrigopluz/spark-plug
```

## Usage

### Basic Usage

``` php
$ci = Rodrigopluz\SparkPlug\Instance::create();

// You can now use its instance
$ci->load->helper('inflector');
```

### As a mock instance for unit testing

``` php
class SparkPlugTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Checks if the CodeIgniter instance is successfully retrieved.
     * 
     * @return void
     */
    public function testCodeIgniterInstance()
    {
        // Path of your test application
        $appPath = __DIR__ . '/TestApp';

        // Instance::create($appPath, $_SERVER, $GLOBALS)
        $ci = \Rodrigopluz\SparkPlug\Instance::create($appPath);

        $this->assertInstanceOf('CI_Controller', $ci);
    }
}
```

**NOTE**: To create a mock instance, a [rodrigopluz/codeigniter](https://github.com/rodrigopluz/codeigniter) package and a test application directory are required. Kindly check the [tests](https://github.com/rodrigopluz/spark-plug/tree/master/tests) directory for more examples.

## Change Log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email rodrigopluz@gmail.com instead of using the issue tracker.

## Credits

- [Rodrigopluz][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/rodrigopluz/spark-plug.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/rodrigopluz/spark-plug/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/rodrigopluz/spark-plug.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/rodrigopluz/spark-plug.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rodrigopluz/spark-plug.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/rodrigopluz/spark-plug
[link-travis]: https://travis-ci.org/rodrigopluz/spark-plug
[link-scrutinizer]: https://scrutinizer-ci.com/g/rodrigopluz/spark-plug/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/rodrigopluz/spark-plug
[link-downloads]: https://packagist.org/packages/rodrigopluz/spark-plug
[link-author]: https://github.com/rodrigopluz
[link-contributors]: ../../contributors
