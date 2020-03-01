<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UserCompany Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="user_company")
 */
class UserCompany extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Person", cascade={"persist"})
     * @JoinColumn(name="id_person", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_person;

    /**
     * 
     * @ManyToOne(targetEntity="Company", cascade={"persist"})
     * @JoinColumn(name="id_company", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_company;

    /**
     * 
     * @ManyToOne(targetEntity="Profile", cascade={"persist"})
     * @JoinColumn(name="id_profile", referencedColumnName="id", nullable=TRUE, unique=FALSE, onDelete="cascade")
     */
    private $_id_profile;

    /**
     * 
     * @Column(name="login", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_login;

    /**
     * 
     * @Column(name="password", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_password;

    /**
     * 
     * @Column(name="last_login", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_last_login;

    /**
     * 
     * @ManyToOne(targetEntity="User_company", cascade={"persist"})
     * @JoinColumn(name="created_by", referencedColumnName="id", nullable=TRUE, unique=FALSE, onDelete="cascade")
     */
    private $_created_by;

    /**
     * 
     * @Column(name="status", type="tinyint", length=1, nullable=TRUE, unique=FALSE)
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
     * @return Usercompany
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id person
     *
     * @return integer
     */
    public function get_id_person()
    {
        return $this->_id_person;
    }

    /**
     * Sets id person
     *
     * @param  integer
     * @return Usercompany
     */
    public function set_id_person(\Person $id_person)
    {
        $this->_id_person = $id_person;
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
     * @return Usercompany
     */
    public function set_id_company(\Company $id_company)
    {
        $this->_id_company = $id_company;
        return $this;
    }
    /**
     * Gets id profile
     *
     * @return integer
     */
    public function get_id_profile()
    {
        return $this->_id_profile;
    }

    /**
     * Sets id profile
     *
     * @param  integer
     * @return Usercompany
     */
    public function set_id_profile(\Profile $id_profile)
    {
        $this->_id_profile = $id_profile;
        return $this;
    }
    /**
     * Gets login
     *
     * @return string
     */
    public function get_login()
    {
        return $this->_login;
    }

    /**
     * Sets login
     *
     * @param  string
     * @return Usercompany
     */
    public function set_login($login)
    {
        $this->_login = $login;
        return $this;
    }
    /**
     * Gets password
     *
     * @return string
     */
    public function get_password()
    {
        return $this->_password;
    }

    /**
     * Sets password
     *
     * @param  string
     * @return Usercompany
     */
    public function set_password($password)
    {
        $this->_password = $password;
        return $this;
    }
    /**
     * Gets last login
     *
     * @return datetime
     */
    public function get_last_login()
    {
        return $this->_last_login;
    }

    /**
     * Sets last login
     *
     * @param  datetime
     * @return Usercompany
     */
    public function set_last_login($last_login)
    {
        $this->_last_login = new \DateTime($last_login);
        return $this;
    }
    /**
     * Gets created by
     *
     * @return integer
     */
    public function get_created_by()
    {
        return $this->_created_by;
    }

    /**
     * Sets created by
     *
     * @param  integer
     * @return Usercompany
     */
    public function set_created_by(\User_company $created_by)
    {
        $this->_created_by = $created_by;
        return $this;
    }
    /**
     * Gets status
     *
     * @return tinyint
     */
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Sets status
     *
     * @param  tinyint
     * @return Usercompany
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }

}