<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Contract Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="contract")
 */
class Contract extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Company", cascade={"persist"})
     * @JoinColumn(name="id_company", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_company;

    /**
     * 
     * @ManyToOne(targetEntity="Employee", cascade={"persist"})
     * @JoinColumn(name="id_employee", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_employee;

    /**
     * 
     * @ManyToOne(targetEntity="Function_role", cascade={"persist"})
     * @JoinColumn(name="id_function", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_function;

    /**
     * 
     * @ManyToOne(targetEntity="User_company", cascade={"persist"})
     * @JoinColumn(name="id_user_company", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_user_company;

    /**
     * 
     * @Column(name="start_date", type="date", nullable=TRUE, unique=FALSE)
     */
    private $_start_date;

    /**
     * 
     * @Column(name="end_date", type="date", nullable=TRUE, unique=FALSE)
     */
    private $_end_date;

    /**
     * 
     * @Column(name="qrcode", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_qrcode;

    /**
     * 
     * @Column(name="status", type="char", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_status;

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
     * @return Contract
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id company
     *
     * @return integer
     */
    public function get_id_company()
    {
        return $this->_id_company;
    }

    /**
     * Sets id company
     *
     * @param  integer
     * @return Contract
     */
    public function set_id_company(\Company $id_company)
    {
        $this->_id_company = $id_company;
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
     * @return Contract
     */
    public function set_id_employee(\Employee $id_employee)
    {
        $this->_id_employee = $id_employee;
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
     * @return Contract
     */
    public function set_id_function(\Function_role $id_function)
    {
        $this->_id_function = $id_function;
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
     * @return Contract
     */
    public function set_id_user_company(\User_company $id_user_company)
    {
        $this->_id_user_company = $id_user_company;
        return $this;
    }
    /**
     * Gets start date
     *
     * @return date
     */
    public function get_start_date()
    {
        return $this->_start_date;
    }

    /**
     * Sets start date
     *
     * @param  date
     * @return Contract
     */
    public function set_start_date($start_date)
    {
        $this->_start_date = $start_date;
        return $this;
    }
    /**
     * Gets end date
     *
     * @return date
     */
    public function get_end_date()
    {
        return $this->_end_date;
    }

    /**
     * Sets end date
     *
     * @param  date
     * @return Contract
     */
    public function set_end_date($end_date)
    {
        $this->_end_date = $end_date;
        return $this;
    }
    /**
     * Gets qrcode
     *
     * @return string
     */
    public function get_qrcode()
    {
        return $this->_qrcode;
    }

    /**
     * Sets qrcode
     *
     * @param  string
     * @return Contract
     */
    public function set_qrcode($qrcode)
    {
        $this->_qrcode = $qrcode;
        return $this;
    }
    /**
     * Gets status
     *
     * @return char
     */
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Sets status
     *
     * @param  char
     * @return Contract
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }

}