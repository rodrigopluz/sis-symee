<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Device Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="device")
 */
class Device extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="uuid", type="string", length=45, nullable=FALSE, unique=FALSE)
     */
    private $_uuid;

    /**
     * 
     * @Column(name="token", type="string", length=255, nullable=FALSE, unique=FALSE)
     */
    private $_token;

    /**
     * 
     * @ManyToOne(targetEntity="Employee", cascade={"persist"})
     * @JoinColumn(name="employee_id", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_employee_id;

    /**
     * 
     * @Column(name="cordova", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_cordova;

    /**
     * 
     * @Column(name="model", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_model;

    /**
     * 
     * @Column(name="platform", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_platform;

    /**
     * 
     * @Column(name="version", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_version;

    /**
     * 
     * @Column(name="manufacturer", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_manufacturer;

    /**
     * 
     * @Column(name="serial", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_serial;

    /**
     * 
     * @Column(name="isvirtual", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_isvirtual;

    /**
     * 
     * @Column(name="status", type="tinyint", length=1, nullable=FALSE, unique=FALSE)
     */
    private $_status;

    /**
     * 
     * @Column(name="last_update", type="datetime", nullable=FALSE, unique=FALSE)
     */
    private $_last_update;

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
     * @return Device
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets uuid
     *
     * @return string
     */
    public function get_uuid()
    {
        return $this->_uuid;
    }

    /**
     * Sets uuid
     *
     * @param  string
     * @return Device
     */
    public function set_uuid($uuid)
    {
        $this->_uuid = $uuid;
        return $this;
    }
    /**
     * Gets token
     *
     * @return string
     */
    public function get_token()
    {
        return $this->_token;
    }

    /**
     * Sets token
     *
     * @param  string
     * @return Device
     */
    public function set_token($token)
    {
        $this->_token = $token;
        return $this;
    }
    /**
     * Gets employee id
     *
     * @return integer
     */
    public function get_employee_id()
    {
        return $this->_employee_id;
    }

    /**
     * Sets employee id
     *
     * @param  integer
     * @return Device
     */
    public function set_employee_id(\Employee $employee_id)
    {
        $this->_employee_id = $employee_id;
        return $this;
    }
    /**
     * Gets cordova
     *
     * @return string
     */
    public function get_cordova()
    {
        return $this->_cordova;
    }

    /**
     * Sets cordova
     *
     * @param  string
     * @return Device
     */
    public function set_cordova($cordova)
    {
        $this->_cordova = $cordova;
        return $this;
    }
    /**
     * Gets model
     *
     * @return string
     */
    public function get_model()
    {
        return $this->_model;
    }

    /**
     * Sets model
     *
     * @param  string
     * @return Device
     */
    public function set_model($model)
    {
        $this->_model = $model;
        return $this;
    }
    /**
     * Gets platform
     *
     * @return string
     */
    public function get_platform()
    {
        return $this->_platform;
    }

    /**
     * Sets platform
     *
     * @param  string
     * @return Device
     */
    public function set_platform($platform)
    {
        $this->_platform = $platform;
        return $this;
    }
    /**
     * Gets version
     *
     * @return string
     */
    public function get_version()
    {
        return $this->_version;
    }

    /**
     * Sets version
     *
     * @param  string
     * @return Device
     */
    public function set_version($version)
    {
        $this->_version = $version;
        return $this;
    }
    /**
     * Gets manufacturer
     *
     * @return string
     */
    public function get_manufacturer()
    {
        return $this->_manufacturer;
    }

    /**
     * Sets manufacturer
     *
     * @param  string
     * @return Device
     */
    public function set_manufacturer($manufacturer)
    {
        $this->_manufacturer = $manufacturer;
        return $this;
    }
    /**
     * Gets serial
     *
     * @return string
     */
    public function get_serial()
    {
        return $this->_serial;
    }

    /**
     * Sets serial
     *
     * @param  string
     * @return Device
     */
    public function set_serial($serial)
    {
        $this->_serial = $serial;
        return $this;
    }
    /**
     * Gets isvirtual
     *
     * @return string
     */
    public function get_isvirtual()
    {
        return $this->_isvirtual;
    }

    /**
     * Sets isvirtual
     *
     * @param  string
     * @return Device
     */
    public function set_isvirtual($isvirtual)
    {
        $this->_isvirtual = $isvirtual;
        return $this;
    }
    /**
     * Gets status
     *
     * @return tinyint
     */
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Sets status
     *
     * @param  tinyint
     * @return Device
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }
    /**
     * Gets last update
     *
     * @return datetime
     */
    public function get_last_update()
    {
        return $this->_last_update;
    }

    /**
     * Sets last update
     *
     * @param  datetime
     * @return Device
     */
    public function set_last_update($last_update)
    {
        $this->_last_update = new \DateTime($last_update);
        return $this;
    }

}