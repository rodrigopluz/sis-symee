<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkDay Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class WorkDay extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get workday by id
     */
    public function get_workday($id)
    {
        return $this->db->get_where('workday', ['id' => $id])->row_array();
    }

    /**
     * Get all workday
     */
    public function get_all_workday()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('workday')->result_array();
    }

    /**
     * function to add new workday
     */
    public function add_workday($params)
    {
        $this->db->insert('workday', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update workday
     */
    public function update_workday($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('workday', $params);
    }

    /**
     * function to delete workday
     */
    public function delete_workday($id)
    {
        return $this->db->delete('workday', ['id' => $id]);
    }
}