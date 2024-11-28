<?php

namespace Rodrigopluz\Slytherin\Middleware;

use Interop\Http\ServerMiddleware\MiddlewareInterface as InteropMiddlewareInterface;

/**
 * Middleware Interface
 *
 * An interface for handling third party middlewares.
 * NOTE: To be removed in v1.0.0. Use DispatcherInterface instead.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
interface MiddlewareInterface extends InteropMiddlewareInterface
{
}
