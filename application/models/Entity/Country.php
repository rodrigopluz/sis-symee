<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Country Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="country")
 */
class Country extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="name", type="string", length=100, nullable=FALSE, unique=FALSE)
     */
    private $_name;

    /**
     * 
     * @Column(name="initial", type="string", length=5, nullable=TRUE, unique=TRUE)
     */
    private $_initial;

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
     * @return Country
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets name
     *
     * @return string
     */
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Sets name
     *
     * @param  string
     * @return Country
     */
    public function set_name($name)
    {
        $this->_name = $name;
        return $this;
    }
    /**
     * Gets initial
     *
     * @return string
     */
    public function get_initial()
    {
        return $this->_initial;
    }

    /**
     * Sets initial
     *
     * @param  string
     * @return Country
     */
    public function set_initial($initial)
    {
        $this->_initial = $initial;
        return $this;
    }

}