<?php

namespace Rodrigopluz\Slytherin\Integration;

use Rodrigopluz\Slytherin\Container\ContainerInterface;
use Rodrigopluz\Slytherin\Integration\Configuration;
use Rodrigopluz\Slytherin\Integration\IntegrationInterface;

/**
 * Configuration Integration
 *
 * Integrates Configuration inside the specified container.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class ConfigurationIntegration implements IntegrationInterface
{
    /**
     * Defines the specified integration.
     *
     * @param  \Rodrigopluz\Slytherin\Container\ContainerInterface $container
     * @param  \Rodrigopluz\Slytherin\Integration\Configuration    $config
     * @return \Rodrigopluz\Slytherin\Container\ContainerInterface
     */
    public function define(ContainerInterface $container, Configuration $config)
    {
        $container->set('Rodrigopluz\Slytherin\Configuration', $config);

        $container->set('Rodrigopluz\Slytherin\Integration\Configuration', $config);

        return $container;
    }
}
