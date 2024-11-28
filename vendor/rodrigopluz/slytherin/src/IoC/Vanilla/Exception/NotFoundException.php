<?php

namespace Rodrigopluz\Slytherin\IoC\Vanilla\Exception;

use Rodrigopluz\Slytherin\Container\Exception\NotFoundException as BaseNotFoundException;

/**
 * Not Found Exception
 *
 * A specified exception in handling errors in containers.
 * NOTE: To be removed in v1.0.0. Use "Container\Exception\NotFoundException" instead.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class NotFoundException extends BaseNotFoundException
{
}
