<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Settings Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="settings")
 */
class Settings extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="type", type="string", length=255, nullable=FALSE, unique=FALSE)
     */
    private $_type;

    /**
     * 
     * @Column(name="description", type="string", length=255, nullable=FALSE, unique=FALSE)
     */
    private $_description;

    /**
     * Gets id
     *
     * @return integer
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Sets id
     *
     * @param  integer
     * @return Settings
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets type
     *
     * @return string
     */
    public function get_type()
    {
        return $this->_type;
    }

    /**
     * Sets type
     *
     * @param  string
     * @return Settings
     */
    public function set_type($type)
    {
        $this->_type = $type;
        return $this;
    }
    /**
     * Gets description
     *
     * @return string
     */
    public function get_description()
    {
        return $this->_description;
    }

    /**
     * Sets description
     *
     * @param  string
     * @return Settings
     */
    public function set_description($description)
    {
        $this->_description = $description;
        return $this;
    }

}