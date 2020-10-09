<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CompanyFunctionCategory Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="company_function_category")
 */
class CompanyFunctionCategory extends CI_Model
{
    /**
     * @Id 
     * @Column(name="id_company", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_company;

    /**
     * @Id 
     * @Column(name="id_function_category", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_function_category;

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
     * @return Companyfunctioncategory
     */
    public function set_id_company($id_company)
    {
        $this->_id_company = $id_company;
        return $this;
    }
    /**
     * Gets id function category
     *
     * @return integer
     */
    public function get_id_function_category()
    {
        return $this->_id_function_category;
    }

    /**
     * Sets id function category
     *
     * @param  integer
     * @return Companyfunctioncategory
     */
    public function set_id_function_category($id_function_category)
    {
        $this->_id_function_category = $id_function_category;
        return $this;
    }

}