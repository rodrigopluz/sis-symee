<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FunctionCategory Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="function_category")
 */
class FunctionCategory extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="category", type="string", length=100, nullable=TRUE, unique=FALSE)
     */
    private $_category;

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
     * @return Functioncategory
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets category
     *
     * @return string
     */
    public function get_category()
    {
        return $this->_category;
    }

    /**
     * Sets category
     *
     * @param  string
     * @return Functioncategory
     */
    public function set_category($category)
    {
        $this->_category = $category;
        return $this;
    }

}