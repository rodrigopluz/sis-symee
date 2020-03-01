<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Calendar Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="calendar")
 */
class Calendar extends CI_Model
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
     * @Column(name="default_notification_before", type="time", nullable=TRUE, unique=FALSE)
     */
    private $_default_notification_before;

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
     * @return Calendar
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
     * @return Calendar
     */
    public function set_id_employee(\Employee $id_employee)
    {
        $this->_id_employee = $id_employee;
        return $this;
    }
    /**
     * Gets default notification before
     *
     * @return time
     */
    public function get_default_notification_before()
    {
        return $this->_default_notification_before;
    }

    /**
     * Sets default notification before
     *
     * @param  time
     * @return Calendar
     */
    public function set_default_notification_before($default_notification_before)
    {
        $this->_default_notification_before = $default_notification_before;
        return $this;
    }

}