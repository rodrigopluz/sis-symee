<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * LocationHistory Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="location_history")
 */
class LocationHistory extends CI_Model
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
     * @return Locationhistory
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
     * @return Locationhistory
     */
    public function set_id_employee(\Employee $id_employee)
    {
        $this->_id_employee = $id_employee;
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
     * @return Locationhistory
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
     * @return Locationhistory
     */
    public function set_coordinates($coordinates)
    {
        $this->_coordinates = $coordinates;
        return $this;
    }

}