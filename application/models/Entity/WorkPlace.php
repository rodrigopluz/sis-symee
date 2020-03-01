<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkPlace Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="workplace")
 */
class WorkPlace extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Address", cascade={"persist"})
     * @JoinColumn(name="id_adress", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_adress;

    /**
     * 
     * @ManyToOne(targetEntity="Company", cascade={"persist"})
     * @JoinColumn(name="id_company", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_company;

    /**
     * 
     * @Column(name="name", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_name;

    /**
     * 
     * @Column(name="information", type="string", nullable=TRUE, unique=FALSE)
     */
    private $_information;

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
     * @return Workplace
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id adress
     *
     * @return integer
     */
    public function get_id_adress()
    {
        return $this->_id_adress;
    }

    /**
     * Sets id adress
     *
     * @param  integer
     * @return Workplace
     */
    public function set_id_adress(\Address $id_adress)
    {
        $this->_id_adress = $id_adress;
        return $this;
    }
    /**
     * Gets id company
     *
     * @return integer
     */
    public function get_id_company()
    {
        return $this->_id_company;
    }

    /**
     * Sets id company
     *
     * @param  integer
     * @return Workplace
     */
    public function set_id_company(\Company $id_company)
    {
        $this->_id_company = $id_company;
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
     * @return Workplace
     */
    public function set_name($name)
    {
        $this->_name = $name;
        return $this;
    }
    /**
     * Gets information
     *
     * @return string
     */
    public function get_information()
    {
        return $this->_information;
    }

    /**
     * Sets information
     *
     * @param  string
     * @return Workplace
     */
    public function set_information($information)
    {
        $this->_information = $information;
        return $this;
    }

}