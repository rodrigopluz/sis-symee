<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkgroupFunction Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class WorkgroupFunction extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get workgroup_function by id
     */
    public function get_workgroup_function($id)
    {
        return $this->db->get_where('workgroup_function', array('id' => $id))->row_array();
    }

    /**
     * Get all workgroup_function
     */
    public function get_all_workgroup_function()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('workgroup_function')->result_array();
    }

    /**
     * function to add new workgroup_function
     */
    public function add_workgroup_function($params)
    {
        $this->db->insert('workgroup_function', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update workgroup_function
     */
    public function update_workgroup_function($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('workgroup_function', $params);
    }

    /**
     * function to delete workgroup_function
     */
    public function delete_workgroup_function($id)
    {
        return $this->db->delete('workgroup_function', array('id' => $id));
    }
}