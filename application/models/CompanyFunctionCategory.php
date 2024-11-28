<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CompanyFunctionCategory Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class CompanyFunctionCategory extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get company_function_category by id
     */
    public function get_company_function_category($id)
    {
        $this->db->select('c.id, c.business_name, c.cnpj, c.email, c.phone, cfc.id_function_category, cfc.id_company, cfc.type, fc.category')
                 ->distinct()
                 ->from('company_function_category cfc')
                 ->join('company c', 'c.id = cfc.id_company', 'left')
                 ->join('function_category fc', 'fc.id = cfc.id_function_category', 'left');

        $query = $this->db->get_where('company_function_category', ['c.id' => $id])->result_array();
        return $query;
    }

    /**
     * Get all company_function_category
     */
    public function get_all_company_function_category()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('company_function_category')->result_array();
    }

    /**
     * function to add new company_function_category
     */
    public function add_company_function_category($params)
    {
        $this->db->insert('company_function_category', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update company_function_category
     */
    public function update_company_function_category($params)
    {
        $this->db->where('id_function_category', $params['id_function_category'],'id_company', $params['id_company']);
        $query = $this->db->update('company_function_category', $params);

        return $query;
    }

    /**
     * function to delete company_function_category
     */
    public function delete_company_function_category($id)
    {
        return $this->db->delete('company_function_category', ['id' => $id]);
    }

    /**
     * get company_function_category_type by id
     */
    public function get_company_function_category_type($id)
    {
        $query = $this->db->get_where('company_function_category', ['id_company' => $id])->result_array();
        return $query;
    }
}