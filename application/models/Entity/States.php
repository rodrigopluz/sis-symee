<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * States Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="states")
 */
class States extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Country", cascade={"persist"})
     * @JoinColumn(name="id_country", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_country;

    /**
     * @Id 
     * @Column(name="sigla", type="char", length=2, nullable=FALSE, unique=FALSE)
     */
    private $_sigla;

    /**
     * 
     * @Column(name="name", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_name;

    /**
     * 
     * @Column(name="coordinates", type="string", nullable=TRUE, unique=FALSE)
     */
    private $_coordinates;

    /**
     * 
     * @Column(name="status", type="char", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_status;

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
     * @return States
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id countrys
     *
     * @return integer
     */
    public function get_id_country()
    {
        return $this->_id_country;
    }

    /**
     * Sets id countrys
     *
     * @param  integer
     * @return States
     */
    public function set_id_country(\Country $id_country)
    {
        $this->_id_country = $id_country;
        return $this;
    }
    /**
     * Gets sigla
     *
     * @return char
     */
    public function get_sigla()
    {
        return $this->_sigla;
    }

    /**
     * Sets sigla
     *
     * @param  char
     * @return States
     */
    public function set_sigla($sigla)
    {
        $this->_sigla = $sigla;
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
     * @return States
     */
    public function set_name($name)
    {
        $this->_name = $name;
        return $this;
    }
    /**
     * Gets coordinates
     *
     * @return string
     */
    public function get_coordinates()
    {
        return $this->_coordinates;
    }

    /**
     * Sets coordinates
     *
     * @param  string
     * @return States
     */
    public function set_coordinates($coordinates)
    {
        $this->_coordinates = $coordinates;
        return $this;
    }
    /**
     * Gets status
     *
     * @return char
     */
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Sets status
     *
     * @param  char
     * @return States
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }

}