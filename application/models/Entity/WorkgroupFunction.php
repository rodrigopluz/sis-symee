<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkgroupFunction Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="workgroup_function")
 */
class WorkgroupFunction extends CI_Model
{
    /**
     * @Id 
     * @Column(name="id_workgroup", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_workgroup;

    /**
     * @Id 
     * @Column(name="id_function", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_function;

    /**
     * 
     * @Column(name="amount", type="integer", length=11, nullable=TRUE, unique=FALSE)
     */
    private $_amount;

    /**
     * Gets id workgroup
     *
     * @return integer
     */
    public function get_id_workgroup()
    {
        return $this->_id_workgroup;
    }

    /**
     * Sets id workgroup
     *
     * @param  integer
     * @return Workgroupfunction
     */
    public function set_id_workgroup($id_workgroup)
    {
        $this->_id_workgroup = $id_workgroup;
        return $this;
    }
    /**
     * Gets id function
     *
     * @return integer
     */
    public function get_id_function()
    {
        return $this->_id_function;
    }

    /**
     * Sets id function
     *
     * @param  integer
     * @return Workgroupfunction
     */
    public function set_id_function($id_function)
    {
        $this->_id_function = $id_function;
        return $this;
    }
    /**
     * Gets amount
     *
     * @return integer
     */
    public function get_amount()
    {
        return $this->_amount;
    }

    /**
     * Sets amount
     *
     * @param  integer
     * @return Workgroupfunction
     */
    public function set_amount($amount)
    {
        $this->_amount = $amount;
        return $this;
    }

}