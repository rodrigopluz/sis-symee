<?php

namespace Rodrigopluz\Slytherin\Debug;

use Rodrigopluz\Slytherin\Application;
use Rodrigopluz\Slytherin\Container\ContainerInterface;
use Rodrigopluz\Slytherin\Integration\Configuration;
use Rodrigopluz\Slytherin\Integration\IntegrationInterface;

/**
 * Error Handler Integration
 *
 * An integration for defined error handlers to be included in Slytherin.
 * NOTE: To be removed in v1.0.0. Move to "Integration" directory instead.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class ErrorHandlerIntegration implements IntegrationInterface
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
        $environment = $config->get('app.environment', 'development');

        $handler = new ErrorHandler($environment);

        if (interface_exists('Whoops\RunInterface') === true) {
            $whoops = new \Whoops\Run;

            $handler = new WhoopsErrorHandler($whoops, $environment);
        }

        if ($environment === 'development') {
            error_reporting(E_ALL) && ini_set('display_errors', 1);

            // NOTE: To be removed in v1.0.0. Use $handler->display() instead.
            $container->set(Application::ERROR_HANDLER, $handler);
        }

        return $container;
    }
}
