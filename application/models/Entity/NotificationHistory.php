<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NotificationHistory Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="notification_history")
 */
class NotificationHistory extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Device", cascade={"persist"})
     * @JoinColumn(name="id_device", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_device;

    /**
     * 
     * @ManyToOne(targetEntity="Contract", cascade={"persist"})
     * @JoinColumn(name="contract_id", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_contract_id;

    /**
     * 
     * @Column(name="date_time_notification", type="datetime", nullable=FALSE, unique=FALSE)
     */
    private $_date_time_notification;

    /**
     * 
     * @Column(name="delivered", type="tinyint", length=1, nullable=FALSE, unique=FALSE)
     */
    private $_delivered;

    /**
     * 
     * @Column(name="response", type="tinyint", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_response;

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
     * @return Notificationhistory
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id device
     *
     * @return integer
     */
    public function get_id_device()
    {
        return $this->_id_device;
    }

    /**
     * Sets id device
     *
     * @param  integer
     * @return Notificationhistory
     */
    public function set_id_device(\Device $id_device)
    {
        $this->_id_device = $id_device;
        return $this;
    }
    /**
     * Gets contract id
     *
     * @return integer
     */
    public function get_contract_id()
    {
        return $this->_contract_id;
    }

    /**
     * Sets contract id
     *
     * @param  integer
     * @return Notificationhistory
     */
    public function set_contract_id(\Contract $contract_id)
    {
        $this->_contract_id = $contract_id;
        return $this;
    }
    /**
     * Gets date time notification
     *
     * @return datetime
     */
    public function get_date_time_notification()
    {
        return $this->_date_time_notification;
    }

    /**
     * Sets date time notification
     *
     * @param  datetime
     * @return Notificationhistory
     */
    public function set_date_time_notification($date_time_notification)
    {
        $this->_date_time_notification = new \DateTime($date_time_notification);
        return $this;
    }
    /**
     * Gets delivered
     *
     * @return tinyint
     */
    public function get_delivered()
    {
        return $this->_delivered;
    }

    /**
     * Sets delivered
     *
     * @param  tinyint
     * @return Notificationhistory
     */
    public function set_delivered($delivered)
    {
        $this->_delivered = $delivered;
        return $this;
    }
    /**
     * Gets response
     *
     * @return tinyint
     */
    public function get_response()
    {
        return $this->_response;
    }

    /**
     * Sets response
     *
     * @param  tinyint
     * @return Notificationhistory
     */
    public function set_response($response)
    {
        $this->_response = $response;
        return $this;
    }

}