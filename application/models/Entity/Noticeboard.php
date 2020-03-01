<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Noticeboard Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="noticeboard")
 */
class Noticeboard extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="title", type="longtext", nullable=FALSE, unique=FALSE)
     */
    private $_title;

    /**
     * 
     * @Column(name="notice", type="longtext", nullable=FALSE, unique=FALSE)
     */
    private $_notice;

    /**
     * 
     * @Column(name="create_timestamp", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_create_timestamp;

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
     * @return Noticeboard
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets title
     *
     * @return longtext
     */
    public function get_title()
    {
        return $this->_title;
    }

    /**
     * Sets title
     *
     * @param  longtext
     * @return Noticeboard
     */
    public function set_title($title)
    {
        $this->_title = $title;
        return $this;
    }
    /**
     * Gets notice
     *
     * @return longtext
     */
    public function get_notice()
    {
        return $this->_notice;
    }

    /**
     * Sets notice
     *
     * @param  longtext
     * @return Noticeboard
     */
    public function set_notice($notice)
    {
        $this->_notice = $notice;
        return $this;
    }
    /**
     * Gets create timestamp
     *
     * @return integer
     */
    public function get_create_timestamp()
    {
        return $this->_create_timestamp;
    }

    /**
     * Sets create timestamp
     *
     * @param  integer
     * @return Noticeboard
     */
    public function set_create_timestamp($create_timestamp)
    {
        $this->_create_timestamp = $create_timestamp;
        return $this;
    }

}