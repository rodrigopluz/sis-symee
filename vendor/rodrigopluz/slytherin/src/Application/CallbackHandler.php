<?php

namespace Rodrigopluz\Slytherin\Application;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rodrigopluz\Slytherin\Container\Container;
use Rodrigopluz\Slytherin\Middleware\Delegate;
use Rodrigopluz\Slytherin\Middleware\Dispatcher;

/**
 * Callback Handler
 *
 * Handles the final callback to be used in the application.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class CallbackHandler
{
    const DISPATCHER = 'Rodrigopluz\Slytherin\Rodrigopluz\DispatcherInterface';

    const ROUTER = 'Rodrigopluz\Slytherin\Rodrigopluz\RouterInterface';

    const RESPONSE = 'Psr\Http\Message\ResponseInterface';

    /**
     * @var \Rodrigopluz\Slytherin\Application\FinalCallback
     */
    protected $callback;

    /**
     * @var \Rodrigopluz\Slytherin\Container\Container
     */
    protected $container;

    /**
     * @var array
     */
    protected $middlewares = array();

    /**
     * Initializes the handler instance.
     *
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = new Container(array(), $container);
    }

    /**
     * Returns a response instance.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request
     * @return callback
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $dispatcher = $this->container->get(self::DISPATCHER);

        if ($this->container->has(self::ROUTER) === true) {
            $router = $this->container->get(self::ROUTER);

            $dispatcher = $dispatcher->router($router);
        }

        $path = $request->getUri()->getPath();

        $method = $request->getMethod();

        $result = $dispatcher->dispatch($method, $path);

        $this->middlewares = $result[1];

        $callback = new FinalCallback($this->container, $result[0]);

        return $this->middleware($callback, $request);
    }

    /**
     * Dispatches the middlewares of the specified request, if there are any.
     *
     * @param  \Rodrigopluz\Slytherin\Application\FinalCallback $callback
     * @param  \Psr\Http\Message\ServerRequestInterface    $request
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    protected function middleware(FinalCallback $callback, ServerRequestInterface $request)
    {
        $response = $this->container->get(self::RESPONSE);

        if (interface_exists(Application::MIDDLEWARE) === true) {
            $middleware = new Dispatcher($this->middlewares, $response);

            $delegate = new Delegate($callback);

            $result = $middleware->process($request, $delegate);
        }

        return isset($result) ? $result : $callback($request);
    }
}
