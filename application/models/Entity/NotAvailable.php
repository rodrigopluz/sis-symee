<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NotAvailable Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="not_available")
 */
class NotAvailable extends CI_Model
{
    /**
     * @Id 
     * @Column(name="id_contract", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_contract;

    /**
     * @Id 
     * @Column(name="id_event", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_event;

    /**
     * Gets id contract
     *
     * @return integer
     */
    public function get_id_contract()
    {
        return $this->_id_contract;
    }

    /**
     * Sets id contract
     *
     * @param  integer
     * @return Notavailable
     */
    public function set_id_contract($id_contract)
    {
        $this->_id_contract = $id_contract;
        return $this;
    }
    /**
     * Gets id event
     *
     * @return integer
     */
    public function get_id_event()
    {
        return $this->_id_event;
    }

    /**
     * Sets id event
     *
     * @param  integer
     * @return Notavailable
     */
    public function set_id_event($id_event)
    {
        $this->_id_event = $id_event;
        return $this;
    }

}