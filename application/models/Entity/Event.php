<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Event Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="event")
 */
class Event extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Calendar", cascade={"persist"})
     * @JoinColumn(name="id_calendar", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_calendar;

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
     * @Column(name="description", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_description;

    /**
     * 
     * @Column(name="notification_before", type="time", nullable=TRUE, unique=FALSE)
     */
    private $_notification_before;

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
     * @return Event
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id calendar
     *
     * @return integer
     */
    public function get_id_calendar()
    {
        return $this->_id_calendar;
    }

    /**
     * Sets id calendar
     *
     * @param  integer
     * @return Event
     */
    public function set_id_calendar(\Calendar $id_calendar)
    {
        $this->_id_calendar = $id_calendar;
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
     * @return Event
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
     * @return Event
     */
    public function set_end_date_time($end_date_time)
    {
        $this->_end_date_time = new \DateTime($end_date_time);
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
     * @return Event
     */
    public function set_description($description)
    {
        $this->_description = $description;
        return $this;
    }
    /**
     * Gets notification before
     *
     * @return time
     */
    public function get_notification_before()
    {
        return $this->_notification_before;
    }

    /**
     * Sets notification before
     *
     * @param  time
     * @return Event
     */
    public function set_notification_before($notification_before)
    {
        $this->_notification_before = $notification_before;
        return $this;
    }

}