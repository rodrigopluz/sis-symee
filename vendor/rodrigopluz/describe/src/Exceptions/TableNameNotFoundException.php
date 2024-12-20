<?php

namespace Rodrigopluz\Describe\Exceptions;

/**
 * Table Name Not Found Exception
 * NOTE: To be removed in v2.0.0. Use TableNotFoundException instead.
 *
 * @package Describe
 * @author  Rodrigopluz <rodrigopluz@gmail.com>
 */
class TableNameNotFoundException extends \PDOException
{
    /**
     * @var string
     */
    protected $message = 'Table name not found on database!';
}
