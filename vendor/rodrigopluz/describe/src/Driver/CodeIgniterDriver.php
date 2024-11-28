<?php

namespace Rodrigopluz\Describe\Driver;

/**
 * CodeIgniter Driver
 *
 * A database driver specifically used for CodeIgniter.
 * NOTE: Should be renamed to "CodeigniterDriver" in v2.0.0.
 *
 * @package Describe
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class CodeIgniterDriver extends DatabaseDriver
{
    /**
     * Initializes the driver instance.
     *
     * @param array $database
     */
    public function __construct(array $database)
    {
        // NOTE: To be removed in v2.0.0. Use $database['default'] outside.
        isset($database['default']) && $database = $database['default'];

        $this->driver = $this->driver($database['dbdriver'], $database);
    }
}
