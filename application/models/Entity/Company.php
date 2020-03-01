<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Company Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="company")
 */
class Company extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Address", cascade={"persist"})
     * @JoinColumn(name="id_address", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_address;

    /**
     * 
     * @Column(name="business_name", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_business_name;

    /**
     * 
     * @Column(name="fantasy_name", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_fantasy_name;

    /**
     * 
     * @Column(name="cnpj", type="integer", length=20, nullable=TRUE, unique=FALSE)
     */
    private $_cnpj;

    /**
     * 
     * @Column(name="state_registration", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_state_registration;

    /**
     * 
     * @Column(name="phone", type="string", length=20, nullable=TRUE, unique=FALSE)
     */
    private $_phone;

    /**
     * 
     * @Column(name="fax", type="string", length=20, nullable=TRUE, unique=FALSE)
     */
    private $_fax;

    /**
     * 
     * @Column(name="site", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_site;

    /**
     * 
     * @Column(name="email", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_email;

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
     * @return Company
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
     * @return Company
     */
    public function set_id_adress(\Address $id_adress)
    {
        $this->_id_adress = $id_adress;
        return $this;
    }
    /**
     * Gets business name
     *
     * @return string
     */
    public function get_business_name()
    {
        return $this->_business_name;
    }

    /**
     * Sets business name
     *
     * @param  string
     * @return Company
     */
    public function set_business_name($business_name)
    {
        $this->_business_name = $business_name;
        return $this;
    }
    /**
     * Gets fantasy name
     *
     * @return string
     */
    public function get_fantasy_name()
    {
        return $this->_fantasy_name;
    }

    /**
     * Sets fantasy name
     *
     * @param  string
     * @return Company
     */
    public function set_fantasy_name($fantasy_name)
    {
        $this->_fantasy_name = $fantasy_name;
        return $this;
    }
    /**
     * Gets cnpj
     *
     * @return integer
     */
    public function get_cnpj()
    {
        return $this->_cnpj;
    }

    /**
     * Sets cnpj
     *
     * @param  integer
     * @return Company
     */
    public function set_cnpj($cnpj)
    {
        $this->_cnpj = $cnpj;
        return $this;
    }
    /**
     * Gets state registration
     *
     * @return string
     */
    public function get_state_registration()
    {
        return $this->_state_registration;
    }

    /**
     * Sets state registration
     *
     * @param  string
     * @return Company
     */
    public function set_state_registration($state_registration)
    {
        $this->_state_registration = $state_registration;
        return $this;
    }
    /**
     * Gets phone
     *
     * @return string
     */
    public function get_phone()
    {
        return $this->_phone;
    }

    /**
     * Sets phone
     *
     * @param  string
     * @return Company
     */
    public function set_phone($phone)
    {
        $this->_phone = $phone;
        return $this;
    }
    /**
     * Gets fax
     *
     * @return string
     */
    public function get_fax()
    {
        return $this->_fax;
    }

    /**
     * Sets fax
     *
     * @param  string
     * @return Company
     */
    public function set_fax($fax)
    {
        $this->_fax = $fax;
        return $this;
    }
    /**
     * Gets site
     *
     * @return string
     */
    public function get_site()
    {
        return $this->_site;
    }

    /**
     * Sets site
     *
     * @param  string
     * @return Company
     */
    public function set_site($site)
    {
        $this->_site = $site;
        return $this;
    }
    /**
     * Gets email
     *
     * @return string
     */
    public function get_email()
    {
        return $this->_email;
    }

    /**
     * Sets email
     *
     * @param  string
     * @return Company
     */
    public function set_email($email)
    {
        $this->_email = $email;
        return $this;
    }

}