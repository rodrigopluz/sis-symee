<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FunctionCategory Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class FunctionCategory extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get function_category by id
     */
    public function get_function_category($id)
    {
        return $this->db->get_where('function_category', ['id' => $id])->row_array();
    }

    /**
     * Get all function_category
     */
    public function get_all_function_category()
    {
        $this->db->order_by('category', 'asc');
        return $this->db->get('function_category')->result_array();
    }

    /**
     * function to add new function_category
     */
    public function add_function_category($params)
    {
        $this->db->insert('function_category', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update function_category
     */
    public function update_function_category($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('function_category', $params);
    }

    /**
     * function to delete function_category
     */
    public function delete_function_category($id)
    {
        return $this->db->delete('function_category', ['id' => $id]);
    }

    /**
     * Get all like search function_category 
     */
    public function get_like_function_category($search)
    {
        $this->db->like('category', $search)->order_by('id', 'desc');
        return $this->db->get('function_category')->result_array();
    }
}