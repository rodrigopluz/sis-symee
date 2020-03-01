<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Noticeboard Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Noticeboard extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get noticeboard by id
     */
    public function get_noticeboard($id)
    {
        return $this->db->get_where('noticeboard', ['id' => $id])->row_array();
    }

    /**
     * Get all noticeboard
     */
    public function get_all_noticeboard()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('noticeboard')->result_array();
    }

    /**
     * function to add new noticeboard
     */
    public function add_noticeboard($params)
    {
        $this->db->insert('noticeboard', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update noticeboard
     */
    public function update_noticeboard($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('noticeboard', $params);
    }

    /**
     * function to delete noticeboard
     */
    public function delete_noticeboard($id)
    {
        return $this->db->delete('noticeboard', ['id' => $id]);
    }
}