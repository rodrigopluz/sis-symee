<?php

namespace Rougin\Slytherin\Middleware;

use Psr\Http\Message\ResponseInterface;
use Rougin\Slytherin\Container\ContainerInterface;
use Rougin\Slytherin\Integration\Configuration;
use Rougin\Slytherin\Integration\IntegrationInterface;
use Zend\Stratigility\MiddlewarePipe;

/**
 * Middleware Integration
 *
 * An integration for Slytherin's Middleware packages.
 *
 * @package Slytherin
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class MiddlewareIntegration implements IntegrationInterface
{
    /**
     * Defines the specified integration.
     *
     * @param  \Rougin\Slytherin\Container\ContainerInterface $container
     * @param  \Rougin\Slytherin\Integration\Configuration    $config
     * @return \Rougin\Slytherin\Container\ContainerInterface
     */
    public function define(ContainerInterface $container, Configuration $config)
    {
        $response = $container->get('Psr\Http\Message\ResponseInterface');

        $stack = $config->get('app.middlewares', array());

        $dispatcher = $this->dispatcher($response, $stack);

        // NOTE: To be removed in v1.0.0. Use Middleware\DispatcherInterface instead.
        $container->set('Rougin\Slytherin\Middleware\MiddlewareInterface', $dispatcher);
        $container->set('Rougin\Slytherin\Middleware\DispatcherInterface', $dispatcher);
        $container->set('Interop\Http\ServerMiddleware\MiddlewareInterface', $dispatcher);

        return $container;
    }

    /**
     * Returns the middleware dispatcher to be used.
     *
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @param  array                               $stack
     * @return \Rougin\Slytherin\Middleware\DispatcherInterface
     */
    protected function dispatcher(ResponseInterface $response, $stack)
    {
        $dispatcher = new Dispatcher($stack, $response);

        if (class_exists('Zend\Stratigility\MiddlewarePipe')) {
            $pipe = new MiddlewarePipe;

            $dispatcher = new StratigilityDispatcher($pipe, $stack, $response);
        }

        return $dispatcher;
    }
}
