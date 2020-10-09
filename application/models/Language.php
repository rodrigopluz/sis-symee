<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Language Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Language extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get language by id
     */
    public function get_language($id)
    {
        return $this->db->get_where('language', ['id' => $id])->row_array();
    }

    /**
     * Get all language
     */
    public function get_all_language()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('language')->result_array();
    }

    /**
     * function to add new language
     */
    public function add_language($params)
    {
        $this->db->insert('language', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update language
     */
    public function update_language($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('language', $params);
    }

    /**
     * function to delete language
     */
    public function delete_language($id)
    {
        return $this->db->delete('language', ['id' => $id]);
    }
}