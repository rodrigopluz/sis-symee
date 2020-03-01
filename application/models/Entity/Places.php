<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Places Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="places")
 */
class Places extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Neighborhood", cascade={"persist"})
     * @JoinColumn(name="id_neighborhood", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_neighborhood;

    /**
     * 
     * @Column(name="name", type="string", length=150, nullable=TRUE, unique=FALSE)
     */
    private $_name;

    /**
     * 
     * @Column(name="type", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_type;

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
     * @return Places
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id neighborhood
     *
     * @return integer
     */
    public function get_id_neighborhood()
    {
        return $this->_id_neighborhood;
    }

    /**
     * Sets id neighborhood
     *
     * @param  integer
     * @return Places
     */
    public function set_id_neighborhood(\Neighborhood $id_neighborhood)
    {
        $this->_id_neighborhood = $id_neighborhood;
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
     * @return Places
     */
    public function set_name($name)
    {
        $this->_name = $name;
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
     * @return Places
     */
    public function set_type($type)
    {
        $this->_type = $type;
        return $this;
    }

}