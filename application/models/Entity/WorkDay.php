<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkDay Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="workday")
 */
class WorkDay extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Workgroup", cascade={"persist"})
     * @JoinColumn(name="id_workgroup", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_workgroup;

    /**
     * 
     * @ManyToOne(targetEntity="Workplace", cascade={"persist"})
     * @JoinColumn(name="id_workplace", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_workplace;

    /**
     * 
     * @Column(name="end_date_time", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_end_date_time;

    /**
     * 
     * @Column(name="start_date_time", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_start_date_time;

    /**
     * 
     * @Column(name="description", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_description;

    /**
     * 
     * @Column(name="amount_employees", type="integer", length=11, nullable=TRUE, unique=FALSE)
     */
    private $_amount_employees;

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
     * @return WorkDay
     */
    public function set_id($id)
    {
        $this->_id = $id;
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
     * @return WorkDay
     */
    public function set_id_workgroup(\Workgroup $id_workgroup)
    {
        $this->_id_workgroup = $id_workgroup;
        return $this;
    }
    /**
     * Gets id workplace
     *
     * @return integer
     */
    public function get_id_workplace()
    {
        return $this->_id_workplace;
    }

    /**
     * Sets id workplace
     *
     * @param  integer
     * @return WorkDay
     */
    public function set_id_workplace(\Workplace $id_workplace)
    {
        $this->_id_workplace = $id_workplace;
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
     * @return WorkDay
     */
    public function set_end_date_time($end_date_time)
    {
        $this->_end_date_time = new \DateTime($end_date_time);
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
     * @return WorkDay
     */
    public function set_start_date_time($start_date_time)
    {
        $this->_start_date_time = new \DateTime($start_date_time);
        return $this;
    }
    /**
     * Gets description
     *
     * @return string
     */
    public function get_description()
    {
        return $this->_description;
    }

    /**
     * Sets description
     *
     * @param  string
     * @return WorkDay
     */
    public function set_description($description)
    {
        $this->_description = $description;
        return $this;
    }
    /**
     * Gets amount employees
     *
     * @return integer
     */
    public function get_amount_employees()
    {
        return $this->_amount_employees;
    }

    /**
     * Sets amount employees
     *
     * @param  integer
     * @return WorkDay
     */
    public function set_amount_employees($amount_employees)
    {
        $this->_amount_employees = $amount_employees;
        return $this;
    }

}