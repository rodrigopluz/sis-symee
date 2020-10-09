<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employee Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="employee")
 */
class Employee extends CI_Model
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
     * @Column(name="status", type="tinyint", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_status;

    /**
     * 
     * @Column(name="occupation", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_occupation;

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
     * @return Employee
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
     * @return Employee
     */
    public function set_id_person(\Person $id_person)
    {
        $this->_id_person = $id_person;
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
     * @return Employee
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }
    /**
     * Gets occupation
     *
     * @return string
     */
    public function get_occupation()
    {
        return $this->_occupation;
    }

    /**
     * Sets occupation
     *
     * @param  string
     * @return Employee
     */
    public function set_occupation($occupation)
    {
        $this->_occupation = $occupation;
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
     * @return Employee
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
     * @return Employee
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
     * @return Employee
     */
    public function set_last_login($last_login)
    {
        $this->_last_login = new \DateTime($last_login);
        return $this;
    }

}