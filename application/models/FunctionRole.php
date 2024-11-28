<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FunctionRole Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class FunctionRole extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get function_role by id
     */
    public function get_function_role($id)
    {
        return $this->db->get_where('function_role', ['id' => $id])->row_array();
    }

    /**
     * Get all function_role
     */
    public function get_all_function_role()
    {
        $this->db->select('c.*, f.*')
                 ->from('function_role f')
                 ->join('function_category c', 'c.id = f.id_function_category', 'left')
                 ->order_by('f.id', 'desc');

        return $this->db->get()->result_array();
    }

    /**
     * function to add new function_role
     */
    public function add_function_role($params)
    {
        $this->db->insert('function_role', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update function_role
     */
    public function update_function_role($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('function_role', $params);
    }

    /**
     * function to delete function_role
     */
    public function delete_function_role($id)
    {
        return $this->db->delete('function_role', ['id' => $id]);
    }

    /**
     * get category function_role
     */
    public function get_category_function_role($id)
    {
        $this->db->select('c.*, f.*')
                 ->distinct() 
                 ->from('function_role f')
                 ->join('function_category c', 'c.id = f.id_function_category', 'left')
                 ->where(['f.id_function_category' => $id])
                 ->order_by('f.id', 'desc');
                 
        return $this->db->get()->result_array();
    }
}