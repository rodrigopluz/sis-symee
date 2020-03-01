<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NotAvailable Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class NotAvailable extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get not_available by id
     */
    public function get_not_available($id)
    {
        return $this->db->get_where('not_available', ['id' => $id])->row_array();
    }

    /**
     * Get all not_available
     */
    public function get_all_not_available()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('not_available')->result_array();
    }

    /**
     * function to add new not_available
     */
    public function add_not_available($params)
    {
        $this->db->insert('not_available', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update not_available
     */
    public function update_not_available($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('not_available', $params);
    }

    /**
     * function to delete not_available
     */
    public function delete_not_available($id)
    {
        return $this->db->delete('not_available', ['id' => $id]);
    }
}