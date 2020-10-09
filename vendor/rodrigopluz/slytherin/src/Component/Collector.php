<?php

namespace Rodrigopluz\Slytherin\Component;

use Rodrigopluz\Slytherin\Container\ContainerInterface;
use Rodrigopluz\Slytherin\Integration\Configuration;

/**
 * Component Collector
 *
 * Collects all components into Collection.
 * NOTE: To be removed in v1.0.0. Use "Integration" instead.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class Collector
{
    /**
     * Collects the specified components.
     *
     * @param  \Rodrigopluz\Slytherin\Container\ContainerInterface $container
     * @param  array                                          $components
     * @param  array|null                                     $globals
     * @return \Rodrigopluz\Slytherin\Component\Collection
     */
    public static function get(ContainerInterface $container, array $components = array(), &$globals = null)
    {
        $configuration = new Configuration;

        $collection = new Collection;

        foreach ((array) $components as $component) {
            $instance = self::prepare($collection, $component);

            $container = $instance->define($container, $configuration);
        }

        $collection->setContainer($container);

        // NOTE: To be removed in v1.0.0. Use Application::container instead.
        $globals === null || $globals['container'] = $container;

        return $collection;
    }

    /**
     * Prepares the component and sets it to the collection.
     *
     * @param  \Rodrigopluz\Slytherin\Component\Collection &$collection
     * @param  string                                 $component
     * @return \Rodrigopluz\Slytherin\Integration\IntegrationInterface
     */
    protected static function prepare(Collection &$collection, $component)
    {
        $instance = new $component;

        $type = $instance->type();

        if (empty($type) === false) {
            $parameters = array($instance->get());

            $type === 'http' && $parameters = $instance->get();

            $class = array($collection, 'set' . ucfirst($type));

            call_user_func_array($class, $parameters);
        }

        return $instance;
    }
}
