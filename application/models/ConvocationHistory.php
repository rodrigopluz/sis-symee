<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ConvocationHistory Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class ConvocationHistory extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get convocation_history by id
     */
    public function get_convocation_history($id)
    {
        return $this->db->get_where('convocation_history', ['id' => $id])->row_array();
    }

    /**
     * Get all convocation_history
     */
    public function get_all_convocation_history()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('convocation_history')->result_array();
    }

    /**
     * function to add new convocation_history
     */
    public function add_convocation_history($params)
    {
        $this->db->insert('convocation_history', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update convocation_history
     */
    public function update_convocation_history($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('convocation_history', $params);
    }

    /**
     * function to delete convocation_history
     */
    public function delete_convocation_history($id)
    {
        return $this->db->delete('convocation_history', ['id' => $id]);
    }
}