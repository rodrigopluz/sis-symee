<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PointRecord Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="point_record")
 */
class PointRecord extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Employee", cascade={"persist"})
     * @JoinColumn(name="id_employee", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_employee;

    /**
     * 
     * @ManyToOne(targetEntity="Workday", cascade={"persist"})
     * @JoinColumn(name="id_workday", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_workday;

    /**
     * 
     * @Column(name="date_time", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_date_time;

    /**
     * 
     * @Column(name="coordinates", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_coordinates;

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
     * @return Pointrecord
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
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
     * @return Pointrecord
     */
    public function set_id_employee(\Employee $id_employee)
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
     * @return Pointrecord
     */
    public function set_id_workday(\Workday $id_workday)
    {
        $this->_id_workday = $id_workday;
        return $this;
    }
    /**
     * Gets date time
     *
     * @return datetime
     */
    public function get_date_time()
    {
        return $this->_date_time;
    }

    /**
     * Sets date time
     *
     * @param  datetime
     * @return Pointrecord
     */
    public function set_date_time($date_time)
    {
        $this->_date_time = new \DateTime($date_time);
        return $this;
    }
    /**
     * Gets coordinates
     *
     * @return string
     */
    public function get_coordinates()
    {
        return $this->_coordinates;
    }

    /**
     * Sets coordinates
     *
     * @param  string
     * @return Pointrecord
     */
    public function set_coordinates($coordinates)
    {
        $this->_coordinates = $coordinates;
        return $this;
    }

}