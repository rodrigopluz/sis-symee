<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FilePdf Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="file_pdf")
 */
class FilePdf extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Contract", cascade={"persist"})
     * @JoinColumn(name="id_contract", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_contract;

    /**
     * 
     * @ManyToOne(targetEntity="User_company", cascade={"persist"})
     * @JoinColumn(name="id_user_company", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_user_company;

    /**
     * 
     * @Column(name="file_name", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_file_name;

    /**
     * 
     * @Column(name="file_size", type="string", length=100, nullable=TRUE, unique=FALSE)
     */
    private $_file_size;

    /**
     * 
     * @Column(name="file_type", type="string", length=100, nullable=TRUE, unique=FALSE)
     */
    private $_file_type;

    /**
     * 
     * @Column(name="file_status", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_file_status;

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
     * @return Filepdf
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
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
     * @return Filepdf
     */
    public function set_id_contract(\Contract $id_contract)
    {
        $this->_id_contract = $id_contract;
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
     * @return Filepdf
     */
    public function set_id_user_company(\User_company $id_user_company)
    {
        $this->_id_user_company = $id_user_company;
        return $this;
    }
    /**
     * Gets file name
     *
     * @return string
     */
    public function get_file_name()
    {
        return $this->_file_name;
    }

    /**
     * Sets file name
     *
     * @param  string
     * @return Filepdf
     */
    public function set_file_name($file_name)
    {
        $this->_file_name = $file_name;
        return $this;
    }
    /**
     * Gets file size
     *
     * @return string
     */
    public function get_file_size()
    {
        return $this->_file_size;
    }

    /**
     * Sets file size
     *
     * @param  string
     * @return Filepdf
     */
    public function set_file_size($file_size)
    {
        $this->_file_size = $file_size;
        return $this;
    }
    /**
     * Gets file type
     *
     * @return string
     */
    public function get_file_type()
    {
        return $this->_file_type;
    }

    /**
     * Sets file type
     *
     * @param  string
     * @return Filepdf
     */
    public function set_file_type($file_type)
    {
        $this->_file_type = $file_type;
        return $this;
    }
    /**
     * Gets file status
     *
     * @return string
     */
    public function get_file_status()
    {
        return $this->_file_status;
    }

    /**
     * Sets file status
     *
     * @param  string
     * @return Filepdf
     */
    public function set_file_status($file_status)
    {
        $this->_file_status = $file_status;
        return $this;
    }

}