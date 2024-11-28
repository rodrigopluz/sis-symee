<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Doctrine\Common\ClassLoader;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Setup;
use Rougin\Describe\Describe;
use Rougin\Describe\Driver\CodeIgniterDriver;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Doctrine wrapper library for CodeIgniter
 *
 * @package  CodeIgniter
 * @category Library
 * @author   Adam Elsodaney  <archfizz.co.uk>
 * @author   Rougin Gutib    <rougingutib@gmail.com>
 * 
 * stackoverflow.com/questions/17121997/integrating-doctrine-with-codeigniter
 */
class Doctrine {

    /**
     * The variable for handling the entity manager
     */
    public $entity_manager;

    private $_describe;
    private $_query;
    private $_query_builder;
    private $_table;
    private $_tables = array();

    /**
     * Setup the CLI and load the specified classes
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * Load the database configuration from CodeIgniter
         */
        
        require APPPATH . 'config/database.php';

        $driver   = $db['default']['dbdriver'];
        $hostname = $db['default']['hostname'];

        if ($driver == 'pdo' && strpos($hostname, ':') !== FALSE)
        {
            $keys    = explode(':', $hostname);
            $driver .= '_' . $keys[0];
        }

        $connection_options = array(
            'driver'        => $driver,
            'user'          => $db['default']['username'],
            'password'      => $db['default']['password'],
            'host'          => $db['default']['hostname'],
            'dbname'        => $db['default']['database'],
            'charset'       => $db['default']['char_set'],
        );

        if ($driver == 'pdo_sqlite')
        {
            $keys = explode(':', $db['default']['hostname']);
            $connection_options['path'] = $keys[1];
        }

        /**
         * With this configuration, your model files need to be in application/models/
         * e.g. Creating a new \User loads the class from application/models/User.php
         */
        
        $metadata_paths   = array(APPPATH . 'models');
        $models           = APPPATH . 'models';
        $models_namespace = '';
        $proxies          = APPPATH . 'models/proxies';

        /**
         * Set $dev_mode to TRUE to disable caching while you develop
         */
        
        $config = Setup::createAnnotationMetadataConfiguration($metadata_paths, $dev_mode = true, $proxies);
        $this->entity_manager = EntityManager::create($connection_options, $config);

        $loader = new ClassLoader($models_namespace, $models);
        $loader->register();

        /**
         * Load the Query Builder
         */

        $this->_query_builder = $this->entity_manager->createQueryBuilder();

        /**
         * Load Describe
         */

        $this->_describe = new Describe(new CodeIgniterDriver($db));
    }

    /**
     * List all data in dropdown format
     *
     * @param  string $description
     * @return array
     */
    public function as_dropdown($description = 'description')
    {
        $table_information = $this->_describe->get_table($this->_table);

        $data        = array('');
        $description = 'get_' . $description;
        $id          = 'get_' . $this->_describe->get_primary_key($this->_table);

        if ( ! method_exists($this->_table, $id))
        {
            $id = camelize($id);
        }

        if ( ! method_exists($this->_table, $description))
        {
            $description = camelize($description);
        }

        $result = $this->_query->getResult();

        foreach ($result as $row) {
            $data[$row->$id()] = ucwords($row->$description());
        }

        return $data;
    }

    /**
     * The Command Line Interface (CLI) configuration for Doctrine
     * 
     * @return object
     */
    public function cli()
    {
        foreach ($GLOBALS as $helper_set_candidate)
        {
            if ($helper_set_candidate instanceof HelperSet)
            {
                $helperSet = $helper_set_candidate;
                break;
            }
        }

        $helperSet = new HelperSet(array(
            'db' => new ConnectionHelper($this->entity_manager->getConnection()),
            'em' => new EntityManagerHelper($this->entity_manager)
        ));

        return ConsoleRunner::run($helperSet);
    }

    /**
     * Retrieve a listing of data from the specified table
     * 
     * @param  string $table
     * @param  array  $delimiters
     * @return Doctrine
     */
    public function get_all($table, $delimiters = array())
    {
        $alias = $this->_get_alias($table);
        $this->_table = $table;

        $this->_query_builder->resetDQLParts();
        $this->_query_builder->select($alias)->from($table, $alias);

        if (isset($delimiters['keyword']) && $delimiters['keyword'] != NULL)
        {
            $this->_find_by_keyword($delimiters['keyword']);
        }

        if (isset($delimiters['per_page']) && $delimiters['per_page'] != NULL)
        {
            $page = $delimiters['per_page'] * $delimiters['page'] - $delimiters['per_page'];

            if ($page == NULL || $page < 0)
            {
                $page = 0;
            }

            $this->_query_builder->setFirstResult($page);
            $this->_query_builder->setMaxResults($delimiters['per_page']);
        }

        $this->_query = $this->_query_builder->getQuery();

        return $this;
    }

    /**
     * Return the result
     * 
     * @return object
     */
    public function result()
    {
        $result = $this->_query->getResult();

        return $result;
    }

    /**
     * Return the number of rows from the result
     * 
     * @return int
     */
    public function total_rows()
    {
        $result = $this->_query->getResult();

        return count($result);
    }

    /**
     * Search for keywords based on the list of columns in the storage
     * 
     * @param  string $keyword
     * @param  string $table
     * @param  array  $tables
     * @param  string $table_alias
     */
    private function _find_by_keyword($keyword, $table = NULL, $tables = array(), $table_alias = NULL)
    {
        if ($table == NULL)
        {
            $table = $this->_table;
        }

        if ($table_alias == NULL)
        {
            $table_alias = $this->_get_alias($table);
        }

        if ( ! array_key_exists($table, $this->_tables))
        {
            $table_information = $this->_describe->get_table($table);
            $this->_tables[$table] = $table_information;
        }
        else
        {
            $table_information = $this->_tables[$table];
        }

        array_push($tables, $table);

        foreach ($table_information as $column)
        {
            if ($column->isForeignKey())
            {
                if ( ! in_array($column->get_referenced_table(), $tables))
                {
                    $foreign_table_alias = $this->_get_alias($column->get_referenced_table());

                    $this->_query_builder->leftJoin($table_alias . '.' . $column->get_field(), $foreign_table_alias);

                    array_push($tables, $column->get_referenced_table());
                    $tables = array_unique($tables);
                    $this->_find_by_keyword($keyword, $column->get_referenced_table(), $tables, $foreign_table_alias);
                }
            }
            else if ( ! $column->isPrimaryKey())
            {
                $this->_query_builder->orWhere(
                    $this->_query_builder->expr()->like($table_alias . '.' . $column->get_field(),
                    $this->_query_builder->expr()->literal('%' . $keyword . '%'))
                );
            }
        }
    }

    /**
     * Get the corresponding alias of the specified table
     * 
     * @param  string $table
     * @return string
     */
    private function _get_alias($table)
    {
        $alias = '';
        $words = explode('_', $table);

        foreach ($words as $word)
        {
            $alias .= $word[0];
        }

        return $alias;
    }

}