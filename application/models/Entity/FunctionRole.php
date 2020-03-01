<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FunctionRole Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="function_role")
 */
class FunctionRole extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Function_category", cascade={"persist"})
     * @JoinColumn(name="id_function_category", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_function_category;

    /**
     * 
     * @Column(name="name", type="string", length=100, nullable=TRUE, unique=FALSE)
     */
    private $_name;

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
     * @return Functionrole
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id function category
     *
     * @return integer
     */
    public function get_id_function_category()
    {
        return $this->_id_function_category;
    }

    /**
     * Sets id function category
     *
     * @param  integer
     * @return Functionrole
     */
    public function set_id_function_category(\Function_category $id_function_category)
    {
        $this->_id_function_category = $id_function_category;
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
     * @return Functionrole
     */
    public function set_name($name)
    {
        $this->_name = $name;
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
     * @return Functionrole
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }

}