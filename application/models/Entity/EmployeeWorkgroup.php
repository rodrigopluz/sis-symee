<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * EmployeeWorkgroup Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="employee_workgroup")
 */
class EmployeeWorkgroup extends CI_Model
{
    /**
     * @Id 
     * @Column(name="id_employee", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_employee;

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
     * Gets id employee
     *
     * @return integer
     */
    public function get_id_employee()
    {
        return $this->_id_employee;
    }

    /**
     * Sets id employee
     *
     * @param  integer
     * @return Employeeworkgroup
     */
    public function set_id_employee($id_employee)
    {
        $this->_id_employee = $id_employee;
        return $this;
    }
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
     * @return Employeeworkgroup
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
     * @return Employeeworkgroup
     */
    public function set_id_function($id_function)
    {
        $this->_id_function = $id_function;
        return $this;
    }

}