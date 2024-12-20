<?php

namespace Rodrigopluz\Slytherin\Container;

use Psr\Container\ContainerInterface as PsrContainerInterface;

/**
 * Container Interface
 *
 * An interface for handling PSR-11 containers.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
interface ContainerInterface extends PsrContainerInterface
{
    /**
     * Sets a new instance to the container.
     *
     * @param  string $id
     * @param  mixed  $concrete
     * @return self
     */
    public function set($id, $concrete);
}
