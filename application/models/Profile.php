<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profile Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Profile extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get profile by id
     */
    public function get_profile($id)
    {
        return $this->db->get_where('profile', ['id' => $id])->row_array();
    }

    /**
     * Get all profile
     */
    public function get_all_profile()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('profile')->result_array();
    }

    /**
     * function to add new profile
     */
    public function add_profile($params)
    {
        $this->db->insert('profile', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update profile
     */
    public function update_profile($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('profile', $params);
    }

    /**
     * function to delete profile
     */
    public function delete_profile($id)
    {
        return $this->db->delete('profile', ['id' => $id]);
    }
}