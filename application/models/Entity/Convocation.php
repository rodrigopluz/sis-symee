<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Convocation Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="convocation")
 */
class Convocation extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * @Id 
     * @Column(name="id_workday", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_workday;

    /**
     * @Id 
     * @Column(name="id_employee", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_employee;

    /**
     * 
     * @Column(name="status", type="char", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_status;

    /**
     * 
     * @Column(name="date_time_send", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_date_time_send;

    /**
     * 
     * @Column(name="date_time_last_reponse", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_date_time_last_reponse;

    /**
     * 
     * @Column(name="justification", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_justification;

    /**
     * 
     * @Column(name="company_response", type="char", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_company_response;

    /**
     * 
     * @Column(name="company_justification", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_company_justification;

    /**
     * 
     * @Column(name="attachment", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_attachment;

    /**
     * 
     * @Column(name="description", type="string", nullable=TRUE, unique=FALSE)
     */
    private $_description;

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
     * @return Convocation
     */
    public function set_id($id)
    {
        $this->_id = $id;
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
     * @return Convocation
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
     * @return Convocation
     */
    public function set_id_employee($id_employee)
    {
        $this->_id_employee = $id_employee;
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
     * @return Convocation
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }
    /**
     * Gets date time send
     *
     * @return datetime
     */
    public function get_date_time_send()
    {
        return $this->_date_time_send;
    }

    /**
     * Sets date time send
     *
     * @param  datetime
     * @return Convocation
     */
    public function set_date_time_send($date_time_send)
    {
        $this->_date_time_send = new \DateTime($date_time_send);
        return $this;
    }
    /**
     * Gets date time last reponse
     *
     * @return datetime
     */
    public function get_date_time_last_reponse()
    {
        return $this->_date_time_last_reponse;
    }

    /**
     * Sets date time last reponse
     *
     * @param  datetime
     * @return Convocation
     */
    public function set_date_time_last_reponse($date_time_last_reponse)
    {
        $this->_date_time_last_reponse = new \DateTime($date_time_last_reponse);
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
     * @return Convocation
     */
    public function set_justification($justification)
    {
        $this->_justification = $justification;
        return $this;
    }
    /**
     * Gets company response
     *
     * @return char
     */
    public function get_company_response()
    {
        return $this->_company_response;
    }

    /**
     * Sets company response
     *
     * @param  char
     * @return Convocation
     */
    public function set_company_response($company_response)
    {
        $this->_company_response = $company_response;
        return $this;
    }
    /**
     * Gets company justification
     *
     * @return string
     */
    public function get_company_justification()
    {
        return $this->_company_justification;
    }

    /**
     * Sets company justification
     *
     * @param  string
     * @return Convocation
     */
    public function set_company_justification($company_justification)
    {
        $this->_company_justification = $company_justification;
        return $this;
    }
    /**
     * Gets attachment
     *
     * @return string
     */
    public function get_attachment()
    {
        return $this->_attachment;
    }

    /**
     * Sets attachment
     *
     * @param  string
     * @return Convocation
     */
    public function set_attachment($attachment)
    {
        $this->_attachment = $attachment;
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
     * @return Convocation
     */
    public function set_description($description)
    {
        $this->_description = $description;
        return $this;
    }

}