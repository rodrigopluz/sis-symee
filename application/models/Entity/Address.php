<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Address Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="address")
 */
class Address extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Places", cascade={"persist"})
     * @JoinColumn(name="id_place", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_place;

    /**
     * 
     * @Column(name="number", type="integer", length=11, nullable=TRUE, unique=FALSE)
     */
    private $_number;

    /**
     * 
     * @Column(name="complement", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_complement;

    /**
     * 
     * @Column(name="zipcode", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_zipcode;

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
     * @return Address
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id place
     *
     * @return integer
     */
    public function get_id_place()
    {
        return $this->_id_place;
    }

    /**
     * Sets id place
     *
     * @param  integer
     * @return Address
     */
    public function set_id_place(\Places $id_place)
    {
        $this->_id_place = $id_place;
        return $this;
    }
    /**
     * Gets number
     *
     * @return integer
     */
    public function get_number()
    {
        return $this->_number;
    }

    /**
     * Sets number
     *
     * @param  integer
     * @return Address
     */
    public function set_number($number)
    {
        $this->_number = $number;
        return $this;
    }
    /**
     * Gets complement
     *
     * @return string
     */
    public function get_complement()
    {
        return $this->_complement;
    }

    /**
     * Sets complement
     *
     * @param  string
     * @return Address
     */
    public function set_complement($complement)
    {
        $this->_complement = $complement;
        return $this;
    }
    /**
     * Gets zipcode
     *
     * @return string
     */
    public function get_zipcode()
    {
        return $this->_zipcode;
    }

    /**
     * Sets zipcode
     *
     * @param  string
     * @return Address
     */
    public function set_zipcode($zipcode)
    {
        $this->_zipcode = $zipcode;
        return $this;
    }

}