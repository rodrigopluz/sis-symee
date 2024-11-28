<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Plan Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Plan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get plans by id
     */
    public function get_plan($id)
    {
        return $this->db->get_where('plans', ['id' => $id])->row_array();
    }

    /**
     * Get all plans
     */
    public function get_all_plan()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('plans')->result_array();
    }

    /**
     * function to add new plans
     */
    public function add_plan($params)
    {
        $this->db->insert('plans', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update plans
     */
    public function update_plan($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('plans', $params);
    }

    /**
     * function to delete plans
     */
    public function delete_plan($id)
    {
        return $this->db->delete('plans', ['id' => $id]);
    }
}