<?php

namespace Rougin\Slytherin\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Dispatcher Interface
 *
 * An interface for handling third party middleware dispatchers.
 *
 * @package Slytherin
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
interface DispatcherInterface extends MiddlewareInterface
{
    /**
     * Processes the specified middlewares from stack.
     * NOTE: To be removed in v1.0.0. Use MiddlewareInterface::process instead.
     *
     * @param  \Psr\Http\Message\RequestInterface  $request
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @param  array                               $stack
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $stack = array());

    /**
     * Adds a new middleware or a list of middlewares in the stack.
     *
     * @param  callable|object|string|array $middleware
     * @return self
     */
    public function push($middleware);

    /**
     * Returns the listing of middlewares included.
     *
     * @return array
     */
    public function stack();
}
