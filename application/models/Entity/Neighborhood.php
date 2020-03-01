<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Neighborhood Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="neighborhood")
 */
class Neighborhood extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="City", cascade={"persist"})
     * @JoinColumn(name="id_city", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_city;

    /**
     * 
     * @Column(name="name", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_name;

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
     * @return Neighborhood
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id city
     *
     * @return integer
     */
    public function get_id_city()
    {
        return $this->_id_city;
    }

    /**
     * Sets id city
     *
     * @param  integer
     * @return Neighborhood
     */
    public function set_id_city(\City $id_city)
    {
        $this->_id_city = $id_city;
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
     * @return Neighborhood
     */
    public function set_name($name)
    {
        $this->_name = $name;
        return $this;
    }

}