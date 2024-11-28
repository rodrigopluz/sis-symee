<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Plan Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="plans")
 */
class Plan extends CI_Model
{
    /**
     * @Id 
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="plan_name", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_plan_name;

    /**
     * 
     * @Column(name="price", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_price;

    /**
     * 
     * @Column(name="type", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_type;

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
     * @return Plans
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets plan name
     *
     * @return string
     */
    public function get_plan_name()
    {
        return $this->_plan_name;
    }

    /**
     * Sets plan name
     *
     * @param  string
     * @return Plans
     */
    public function set_plan_name($plan_name)
    {
        $this->_plan_name = $plan_name;
        return $this;
    }
    /**
     * Gets price
     *
     * @return string
     */
    public function get_price()
    {
        return $this->_price;
    }

    /**
     * Sets price
     *
     * @param  string
     * @return Plans
     */
    public function set_price($price)
    {
        $this->_price = $price;
        return $this;
    }
    /**
     * Gets type
     *
     * @return string
     */
    public function get_type()
    {
        return $this->_type;
    }

    /**
     * Sets type
     *
     * @param  string
     * @return Plans
     */
    public function set_type($type)
    {
        $this->_type = $type;
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
     * @return Plans
     */
    public function set_description($description)
    {
        $this->_description = $description;
        return $this;
    }

}