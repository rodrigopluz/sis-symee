<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profile Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="profile")
 */
class Profile extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="name", type="string", length=100, nullable=TRUE, unique=FALSE)
     */
    private $_name;

    /**
     * 
     * @Column(name="acl", type="string", nullable=TRUE, unique=FALSE)
     */
    private $_acl;

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
     * @return Profile
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
     * @return Profile
     */
    public function set_name($name)
    {
        $this->_name = $name;
        return $this;
    }
    /**
     * Gets acl
     *
     * @return string
     */
    public function get_acl()
    {
        return $this->_acl;
    }

    /**
     * Sets acl
     *
     * @param  string
     * @return Profile
     */
    public function set_acl($acl)
    {
        $this->_acl = $acl;
        return $this;
    }

}