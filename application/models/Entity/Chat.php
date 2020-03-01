<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Chat Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="chat")
 */
class Chat extends CI_Model
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
     * @ManyToOne(targetEntity="User_company", cascade={"persist"})
     * @JoinColumn(name="id_user_company", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_user_company;

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
     * @return Chat
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
     * @return Chat
     */
    public function set_id_employee(\Employee $id_employee)
    {
        $this->_id_employee = $id_employee;
        return $this;
    }
    /**
     * Gets id user company
     *
     * @return integer
     */
    public function get_id_user_company()
    {
        return $this->_id_user_company;
    }

    /**
     * Sets id user company
     *
     * @param  integer
     * @return Chat
     */
    public function set_id_user_company(\User_company $id_user_company)
    {
        $this->_id_user_company = $id_user_company;
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
     * @return Chat
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
     * @return Chat
     */
    public function set_end_date_time($end_date_time)
    {
        $this->_end_date_time = new \DateTime($end_date_time);
        return $this;
    }

}