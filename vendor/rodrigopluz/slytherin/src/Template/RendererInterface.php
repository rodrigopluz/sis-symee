<?php

namespace Rodrigopluz\Slytherin\Template;

/**
 * Renderer Interface
 *
 * An interface for handling third party template engines.
 *
 * @package Slytherin
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
interface RendererInterface
{
    /**
     * Renders a template.
     *
     * @param  string $template
     * @param  array  $data
     * @return string
     */
    public function render($template, array $data = array());
}
