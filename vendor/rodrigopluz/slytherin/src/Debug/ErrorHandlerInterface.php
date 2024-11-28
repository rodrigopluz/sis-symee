<?php

namespace Rodrigopluz\Slytherin\Debug;

/**
 * Error Handler Interface
 *
 * An interface for handling third party error handlers.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
interface ErrorHandlerInterface
{
    /**
     * Registers the instance as an error handler.
     *
     * @return object
     */
    public function display();
}
