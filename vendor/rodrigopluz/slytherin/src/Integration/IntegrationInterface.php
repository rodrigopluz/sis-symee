<?php

namespace Rodrigopluz\Slytherin\Integration;

use Rodrigopluz\Slytherin\Integration\Configuration;
use Rodrigopluz\Slytherin\Container\ContainerInterface;

/**
 * Integration Interface
 *
 * An interface for handling integrations to Slytherin.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
interface IntegrationInterface
{
    /**
     * Defines the specified integration.
     *
     * @param  \Rodrigopluz\Slytherin\Container\ContainerInterface $container
     * @param  \Rodrigopluz\Slytherin\Integration\Configuration    $config
     * @return \Rodrigopluz\Slytherin\Container\ContainerInterface
     */
    public function define(ContainerInterface $container, Configuration $config);
}
