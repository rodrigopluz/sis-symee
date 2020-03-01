<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * States Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class States extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get states by id
     */
    public function get_states($id)
    {
        return $this->db->get_where('states', ['sigla' => $id])->row_array();
    }

    /**
     * Get all states
     */
    public function get_all_states()
    {
        $this->db->order_by('id', 'asc');
        return $this->db->get('states')->result_array();
    }

    /**
     * function to add new states
     */
    public function add_states($params)
    {
        $this->db->insert('states', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update states
     */
    public function update_states($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('states', $params);
    }

    /**
     * function to delete states
     */
    public function delete_states($id)
    {
        return $this->db->delete('states', ['id' => $id]);
    }
}