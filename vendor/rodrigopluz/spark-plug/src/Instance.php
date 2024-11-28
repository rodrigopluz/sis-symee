<?php

namespace Rodrigopluz\SparkPlug;

/**
 * Instance
 *
 * Creates an instance based on SparkPlug class.
 *
 * @package SparkPlug
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class Instance
{
    /**
     * Creates an instance of CodeIgniter based on the application path.
     *
     * @param  string $appPath
     * @param  array  $server
     * @param  array  $globals
     * @return \CI_Controller
     */
    public static function create($appPath = '', array $server = [], array $globals = [])
    {
        $globals = (empty($globals)) ? $GLOBALS : $globals;
        $server = (empty($server)) ? $_SERVER : $server;

        $sparkPlug = new SparkPlug($globals, $server, $appPath);
        
        return $sparkPlug->getCodeIgniter();
    }
}
