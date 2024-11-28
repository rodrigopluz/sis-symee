<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Workgroup Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Workgroup extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get workgroup by id
     */
    public function get_workgroup($id)
    {
        return $this->db->get_where('workgroup', array('id' => $id))->row_array();
    }

    /**
     * Get all workgroup
     */
    public function get_all_workgroup()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('workgroup')->result_array();
    }

    /**
     * function to add new workgroup
     */
    public function add_workgroup($params)
    {
        $this->db->insert('workgroup', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update workgroup
     */
    public function update_workgroup($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('workgroup', $params);
    }

    /**
     * function to delete workgroup
     */
    public function delete_workgroup($id)
    {
        return $this->db->delete('workgroup', array('id' => $id));
    }
}