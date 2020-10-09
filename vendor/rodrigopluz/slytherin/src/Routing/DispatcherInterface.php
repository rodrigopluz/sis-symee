<?php

namespace Rodrigopluz\Slytherin\Rodrigopluz;

/**
 * Dispatcher Interface
 *
 * An interface for handling third party route dispatchers.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
interface DispatcherInterface
{
    /**
     * Dispatches against the provided HTTP method verb and URI.
     *
     * @param  string $httpMethod
     * @param  string $uri
     * @return array|mixed
     */
    public function dispatch($httpMethod, $uri);

    /**
     * Sets the router and parse its available routes if needed.
     *
     * @param  \Rodrigopluz\Slytherin\Rodrigopluz\RouterInterface $router
     * @return self
     */
    public function router(RouterInterface $router);
}
