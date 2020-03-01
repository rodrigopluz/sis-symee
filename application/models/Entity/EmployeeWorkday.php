<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * EmployeeWorkday Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="employee_workday")
 */
class EmployeeWorkday extends CI_Model
{
    /**
     * @Id 
     * @Column(name="id_employee", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_employee;

    /**
     * @Id 
     * @Column(name="id_workday", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_workday;

    /**
     * 
     * @ManyToOne(targetEntity="Function_role", cascade={"persist"})
     * @JoinColumn(name="id_function", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_function;

    /**
     * 
     * @Column(name="start_date_time", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_start_date_time;

    /**
     * 
     * @Column(name="end_date_time", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_end_date_time;

    /**
     * 
     * @Column(name="allow_store_location", type="tinyint", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_allow_store_location;

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
     * @return Employeeworkday
     */
    public function set_id_employee($id_employee)
    {
        $this->_id_employee = $id_employee;
        return $this;
    }
    /**
     * Gets id workday
     *
     * @return integer
     */
    public function get_id_workday()
    {
        return $this->_id_workday;
    }

    /**
     * Sets id workday
     *
     * @param  integer
     * @return Employeeworkday
     */
    public function set_id_workday($id_workday)
    {
        $this->_id_workday = $id_workday;
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
     * @return Employeeworkday
     */
    public function set_id_function(\Function_role $id_function)
    {
        $this->_id_function = $id_function;
        return $this;
    }
    /**
     * Gets start date time
     *
     * @return datetime
     */
    public function get_start_date_time()
    {
        return $this->_start_date_time;
    }

    /**
     * Sets start date time
     *
     * @param  datetime
     * @return Employeeworkday
     */
    public function set_start_date_time($start_date_time)
    {
        $this->_start_date_time = new \DateTime($start_date_time);
        return $this;
    }
    /**
     * Gets end date time
     *
     * @return datetime
     */
    public function get_end_date_time()
    {
        return $this->_end_date_time;
    }

    /**
     * Sets end date time
     *
     * @param  datetime
     * @return Employeeworkday
     */
    public function set_end_date_time($end_date_time)
    {
        $this->_end_date_time = new \DateTime($end_date_time);
        return $this;
    }
    /**
     * Gets allow store location
     *
     * @return tinyint
     */
    public function get_allow_store_location()
    {
        return $this->_allow_store_location;
    }

    /**
     * Sets allow store location
     *
     * @param  tinyint
     * @return Employeeworkday
     */
    public function set_allow_store_location($allow_store_location)
    {
        $this->_allow_store_location = $allow_store_location;
        return $this;
    }

}