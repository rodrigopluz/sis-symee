<?php

namespace Rodrigopluz\Slytherin\Rodrigopluz;

use Rodrigopluz\Slytherin\Container\ContainerInterface;
use Rodrigopluz\Slytherin\Integration\Configuration;
use Rodrigopluz\Slytherin\Integration\IntegrationInterface;

/**
 * Rodrigopluz Integration
 *
 * An integration for Slytherin's Rodrigopluz packages.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class RodrigopluzIntegration implements IntegrationInterface
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
        $dispatcher = new Dispatcher;

        $router = $config->get('app.router', new Router);

        if (interface_exists('FastRoute\Dispatcher')) {
            $dispatcher = new FastRouteDispatcher;
        }

        if (class_exists('Phroute\Phroute\Dispatcher')) {
            $resolver = new PhrouteResolver($container);

            $dispatcher = new PhrouteDispatcher(null, $resolver);
        }

        $container->set('Rodrigopluz\Slytherin\Rodrigopluz\DispatcherInterface', $dispatcher);

        $container->set('Rodrigopluz\Slytherin\Rodrigopluz\RouterInterface', $router);

        return $container;
    }
}
