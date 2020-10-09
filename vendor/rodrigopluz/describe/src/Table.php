<?php

namespace Rodrigopluz\Describe;

/**
 * Table
 *
 * Stores the table information from the given results.
 *
 * @package Describe
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class Table
{
    /**
     * @var \Rodrigopluz\Describe\Driver\DriverInterface
     */
    protected $driver;

    /**
     * @var string
     */
    protected $name;

    /**
     * Initializes the table instance.
     *
     * @param string                                  $name
     * @param \Rodrigopluz\Describe\Driver\DriverInterface $driver
     */
    public function __construct($name, Driver\DriverInterface $driver)
    {
        $this->driver = $driver;

        $this->name = $name;
    }

    /**
     * Returns an array of Column instances.
     *
     * @return \Rodrigopluz\Describe\Column[]
     */
    public function columns()
    {
        return $this->driver->columns($this->name);
    }

    /**
     * Returns the name of the table.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Returns the primary key of a table.
     *
     * @return \Rodrigopluz\Describe\Column|null
     */
    public function primary()
    {
        foreach ($this->columns() as $column) {
            $primary = $column->isPrimaryKey();

            $primary && $result = $column;
        }

        return isset($result) ? $result : null;
    }
}
