<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ConvocationHistory Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="convocation_history")
 */
class ConvocationHistory extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="date_time_response", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_date_time_response;

    /**
     * 
     * @Column(name="status", type="string", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_status;

    /**
     * 
     * @Column(name="justification", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_justification;

    /**
     * 
     * @ManyToOne(targetEntity="Convocation", cascade={"persist"})
     * @JoinColumn(name="id_convocation", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_convocation;

    /**
     * 
     * @Column(name="id_workday", type="integer", length=11, nullable=TRUE, unique=FALSE)
     */
    private $_id_workday;

    /**
     * 
     * @Column(name="id_employee", type="integer", length=11, nullable=TRUE, unique=FALSE)
     */
    private $_id_employee;

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
     * @return Convocationhistory
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets date time response
     *
     * @return datetime
     */
    public function get_date_time_response()
    {
        return $this->_date_time_response;
    }

    /**
     * Sets date time response
     *
     * @param  datetime
     * @return Convocationhistory
     */
    public function set_date_time_response($date_time_response)
    {
        $this->_date_time_response = new \DateTime($date_time_response);
        return $this;
    }
    /**
     * Gets status
     *
     * @return string
     */
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Sets status
     *
     * @param  string
     * @return Convocationhistory
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }
    /**
     * Gets justification
     *
     * @return string
     */
    public function get_justification()
    {
        return $this->_justification;
    }

    /**
     * Sets justification
     *
     * @param  string
     * @return Convocationhistory
     */
    public function set_justification($justification)
    {
        $this->_justification = $justification;
        return $this;
    }
    /**
     * Gets id convocation
     *
     * @return integer
     */
    public function get_id_convocation()
    {
        return $this->_id_convocation;
    }

    /**
     * Sets id convocation
     *
     * @param  integer
     * @return Convocationhistory
     */
    public function set_id_convocation(\Convocation $id_convocation)
    {
        $this->_id_convocation = $id_convocation;
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
     * @return Convocationhistory
     */
    public function set_id_workday($id_workday)
    {
        $this->_id_workday = $id_workday;
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
     * @return Convocationhistory
     */
    public function set_id_employee($id_employee)
    {
        $this->_id_employee = $id_employee;
        return $this;
    }

}