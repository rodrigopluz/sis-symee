<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Settings Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Settings extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get settings by id
     */
    public function get_settings($id)
    {
        return $this->db->get_where('settings', ['id' => $id])->row_array();
    }

    /**
     * Get all settings
     */
    public function get_all_settings()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('settings')->result_array();
    }

    /**
     * function to add new settings
     */
    public function add_settings($params)
    {
        $this->db->insert('settings', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update settings
     */
    public function update_settings($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('settings', $params);
    }

    /**
     * function to delete settings
     */
    public function delete_settings($id)
    {
        return $this->db->delete('settings', ['id' => $id]);
    }
}