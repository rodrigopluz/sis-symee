<?php

namespace Rodrigopluz\Slytherin\Template;

use Rodrigopluz\Slytherin\Container\ContainerInterface;
use Rodrigopluz\Slytherin\Integration\Configuration;
use Rodrigopluz\Slytherin\Integration\IntegrationInterface;

/**
 * Renderer Integration
 *
 * An integration for template renderers to be included in Slytherin.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class RendererIntegration implements IntegrationInterface
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
        $renderer = new Renderer($config->get('app.views', ''));

        if (class_exists('Twig_Environment') === true) {
            $loader = new \Twig_Loader_Filesystem($config->get('app.views', ''));

            $renderer = new TwigRenderer(new \Twig_Environment($loader));
        }

        $container->set('Rodrigopluz\Slytherin\Template\RendererInterface', $renderer);

        return $container;
    }
}
